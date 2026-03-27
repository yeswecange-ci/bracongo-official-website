<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->isAdmin() && $user->hasPermission('users.view');
    }

    public function view(User $user, User $model): bool
    {
        if ($user->id === $model->id) {
            return true;
        }

        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isAdmin() && $user->hasPermission('users.view')) {
            return $model->isEditor();
        }

        return false;
    }

    public function resetTwoFactor(User $user, User $model): bool
    {
        return $user->isSuperAdmin();
    }
}
