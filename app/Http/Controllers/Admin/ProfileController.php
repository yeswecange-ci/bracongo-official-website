<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Invitation;
use App\Models\MessageContact;
use App\Models\Permission;
use App\Models\User;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use HandlesImageUpload;

    public function edit(): View
    {
        $user = auth()->user();
        $permissionsForDisplay = Permission::query()->orderBy('label')->get()->filter(
            fn (Permission $p) => $user->hasPermission($p->code)
        );

        $stats = null;
        if ($user->isSuperAdmin()) {
            $stats = [
                'users' => User::query()->visibleInAdminUserList()->count(),
                'invitations_pending' => Invitation::query()->pending()->count(),
                'messages_non_lus' => MessageContact::query()->where('lu', false)->count(),
            ];
        } elseif ($user->isAdmin()) {
            $stats = [
                'editors' => User::query()->where('role', 'editor')->count(),
                'invitations_pending' => Invitation::query()->pending()->count(),
            ];
        }

        return view('admin.profile.edit', [
            'user' => $user,
            'permissionsForDisplay' => $permissionsForDisplay,
            'stats' => $stats,
        ]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($user->avatar && str_starts_with($user->avatar, 'uploads/avatars')) {
                $old = public_path($user->avatar);
                if (is_file($old)) {
                    @unlink($old);
                }
            }
            $data['avatar'] = $this->uploadImage($request->file('avatar'), 'uploads/avatars', 'avatar');
        } else {
            unset($data['avatar']);
        }

        $plainPassword = $data['password'] ?? null;
        unset($data['password']);

        $user->fill($data);
        if (filled($plainPassword)) {
            $user->password = $plainPassword;
        }
        $user->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil mis à jour.');
    }
}
