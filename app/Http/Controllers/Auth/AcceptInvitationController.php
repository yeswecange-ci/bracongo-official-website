<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AcceptInvitationController extends Controller
{
    public function show(Request $request, string $token): JsonResponse|View
    {
        $invitation = Invitation::query()
            ->where('token', Invitation::hashToken($token))
            ->first();

        if (! $invitation || ! $invitation->isValid()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Invitation invalide ou expirée.'], 404);
            }

            return view('invitation.invalid');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'email' => $invitation->email,
                'expires_at' => $invitation->expires_at->toIso8601String(),
            ]);
        }

        return view('invitation.accept', ['invitation' => $invitation, 'token' => $token]);
    }

    public function accept(Request $request, string $token): JsonResponse|RedirectResponse
    {
        $invitation = Invitation::query()
            ->where('token', Invitation::hashToken($token))
            ->first();

        if (! $invitation || ! $invitation->isValid()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Invitation invalide ou expirée.'], 404);
            }

            return redirect()->route('invitation.show', ['token' => $token]);
        }

        if (User::query()->where('email', $invitation->email)->exists()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Un compte existe déjà pour cet e-mail.'], 422);
            }

            return redirect()->route('invitation.show', ['token' => $token])->with('error', 'Un compte existe déjà pour cet e-mail.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::min(12)->mixedCase()->numbers()->symbols()],
        ]);

        $email = $invitation->email;

        DB::transaction(function () use ($validated, $invitation) {
            $newUser = User::create([
                'name' => $validated['name'],
                'email' => $invitation->email,
                'password' => $validated['password'],
                'role' => $invitation->role,
                'status' => UserStatus::Active,
                'invited_by' => $invitation->invited_by,
                'email_verified_at' => now(),
            ]);

            $meta = $invitation->meta;
            if (
                $invitation->role === UserRole::Editor->value
                && is_array($meta)
                && isset($meta['permission_ids'])
                && is_array($meta['permission_ids'])
                && $meta['permission_ids'] !== []
            ) {
                foreach ($meta['permission_ids'] as $permissionId) {
                    UserPermission::create([
                        'user_id' => $newUser->id,
                        'permission_id' => (int) $permissionId,
                        'effect' => 'allow',
                    ]);
                }
            }

            $invitation->update(['accepted_at' => now()]);
        });

        if ($request->wantsJson()) {
            $user = User::where('email', $email)->first();

            return response()->json([
                'message' => 'Compte créé.',
                'data' => $user?->only(['id', 'name', 'email', 'role', 'status']),
            ], 201);
        }

        return redirect()->route('admin.login')->with('success', 'Compte créé. Vous pouvez vous connecter.');
    }
}
