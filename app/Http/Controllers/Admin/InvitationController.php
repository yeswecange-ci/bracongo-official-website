<?php

namespace App\Http\Controllers\Admin;

use App\Enums\InvitationExpiresHours;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\ParametresSite;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use App\Notifications\InvitationEditeurNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class InvitationController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $this->authorize('viewAny', Invitation::class);

        $query = Invitation::query()
            ->with('inviter:id,name,email')
            ->orderByDesc('created_at')
            ->limit(100);

        if ($request->user()->isAdmin() && ! $request->user()->isSuperAdmin()) {
            $query->where('invited_by', $request->user()->id);
        }

        $invitations = $query->get();

        $invitationExpiresHours = $this->invitationExpiresHoursEnum();

        $assignableRoles = User::assignableInvitationRoles($request->user());
        $editorPermissionIds = RolePermission::query()
            ->where('role', UserRole::Editor->value)
            ->pluck('permission_id');
        $editorPermissions = Permission::query()
            ->whereIn('id', $editorPermissionIds)
            ->orderBy('code')
            ->get(['id', 'code', 'label']);

        if ($request->wantsJson()) {
            return response()->json(['data' => $invitations]);
        }

        return view('admin.invitations.index', compact(
            'invitations',
            'invitationExpiresHours',
            'assignableRoles',
            'editorPermissions'
        ));
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $this->authorize('create', Invitation::class);

        $assignableValues = array_map(
            static fn (UserRole $r) => $r->value,
            User::assignableInvitationRoles($request->user())
        );

        if ($assignableValues === []) {
            throw ValidationException::withMessages([
                'email' => 'Vous ne pouvez pas envoyer d’invitation.',
            ]);
        }

        $validated = $request->validate([
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'role' => ['required', Rule::in($assignableValues)],
            'permission_ids' => ['sometimes', 'array'],
            'permission_ids.*' => ['integer', 'exists:permissions,id'],
        ]);

        if (Invitation::pending()->where('email', $validated['email'])->exists()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Une invitation est déjà en cours pour cet e-mail.'], 422);
            }

            return redirect()->route('admin.invitations.index')->with('error', 'Une invitation est déjà en cours pour cet e-mail.');
        }

        $roleEnum = UserRole::from($validated['role']);
        $meta = null;

        if ($roleEnum === UserRole::Editor) {
            $allowedIds = RolePermission::query()
                ->where('role', UserRole::Editor->value)
                ->pluck('permission_id');

            $ids = $validated['permission_ids'] ?? [];
            if ($ids === []) {
                $meta = null;
            } else {
                foreach ($ids as $pid) {
                    if (! $allowedIds->contains((int) $pid)) {
                        throw ValidationException::withMessages([
                            'permission_ids' => 'Une ou plusieurs permissions ne sont pas valides pour le rôle éditeur.',
                        ]);
                    }
                }
                $meta = ['permission_ids' => array_values(array_map('intval', $ids))];
            }
        }

        $hours = $this->invitationExpiresHoursEnum()->toInt();

        $plain = Str::random(64);

        $invitation = Invitation::create([
            'email' => $validated['email'],
            'token' => Invitation::hashToken($plain),
            'role' => $validated['role'],
            'invited_by' => $request->user()->id,
            'expires_at' => now()->addHours($hours),
            'meta' => $meta,
        ]);

        try {
            Notification::route('mail', $invitation->email)
                ->notify(new InvitationEditeurNotification($plain));
        } catch (\Throwable $e) {
            report($e);
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Invitation créée mais l’e-mail n’a pas pu être envoyé.'], 500);
            }

            return redirect()->route('admin.invitations.index')->with('error', 'Invitation enregistrée mais l’e-mail n’a pas pu être envoyé (vérifiez la configuration mail).');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Invitation envoyée.',
                'data' => $invitation->load('inviter:id,name,email'),
            ], 201);
        }

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation envoyée à '.$invitation->email.'.');
    }

    public function destroy(Request $request, Invitation $invitation): JsonResponse|RedirectResponse
    {
        $this->authorize('delete', $invitation);

        if ($invitation->isAccepted()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Cette invitation est déjà acceptée.'], 422);
            }

            return redirect()->route('admin.invitations.index')->with('error', 'Cette invitation est déjà acceptée.');
        }

        if ($invitation->isRevoked()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Cette invitation est déjà révoquée.'], 422);
            }

            return redirect()->route('admin.invitations.index')->with('error', 'Cette invitation est déjà révoquée.');
        }

        $invitation->forceFill(['revoked_at' => now()])->save();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Invitation révoquée.']);
        }

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation révoquée.');
    }

    private function invitationExpiresHoursEnum(): InvitationExpiresHours
    {
        $v = ParametresSite::instance()->invitation_expires_hours;

        if ($v instanceof InvitationExpiresHours) {
            return $v;
        }

        $s = is_numeric($v) ? (string) (int) $v : (string) $v;

        return InvitationExpiresHours::tryFrom($s)
            ?? InvitationExpiresHours::default();
    }
}
