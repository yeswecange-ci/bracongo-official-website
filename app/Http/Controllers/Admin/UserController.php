<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $this->authorize('viewAny', User::class);

        $query = User::query()->visibleInAdminUserList()->orderBy('name');

        if ($request->user()->isAdmin() && ! $request->user()->isSuperAdmin()) {
            $query->where('role', UserRole::Editor->value);
        }

        $users = $query->get([
            'id', 'name', 'email', 'role', 'status',
            'email_verified_at', 'two_factor_confirmed_at', 'created_at',
        ]);

        if ($request->wantsJson()) {
            return response()->json(['data' => $users]);
        }

        return view('admin.users.index', compact('users'));
    }

    public function show(Request $request, User $user): JsonResponse|View
    {
        $this->authorize('view', $user);

        if ($request->wantsJson()) {
            return response()->json([
                'data' => $user->only([
                    'id', 'name', 'email', 'role', 'status', 'email_verified_at',
                    'two_factor_confirmed_at', 'created_at', 'updated_at', 'last_login_at',
                ]),
            ]);
        }

        return view('admin.users.show', compact('user'));
    }

    public function resetTwoFactor(Request $request, User $user): JsonResponse|RedirectResponse
    {
        $this->authorize('resetTwoFactor', $user);

        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        if ($request->wantsJson()) {
            return response()->json(['message' => '2FA réinitialisé pour cet utilisateur.']);
        }

        return redirect()->route('admin.users.show', $user)->with('success', '2FA réinitialisé.');
    }
}
