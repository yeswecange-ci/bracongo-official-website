<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'invited_by',
        'last_login_at',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
            'last_login_at' => 'datetime',
            'status' => UserStatus::class,
        ];
    }

    public function roleEnum(): UserRole
    {
        return UserRole::from($this->role);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === UserRole::SuperAdmin->value;
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin->value;
    }

    public function isEditor(): bool
    {
        return $this->role === UserRole::Editor->value;
    }

    /**
     * Rôles qu’un utilisateur peut attribuer via une invitation.
     *
     * @return list<UserRole>
     */
    public static function assignableInvitationRoles(self $inviter): array
    {
        if ($inviter->isSuperAdmin()) {
            return [UserRole::Admin, UserRole::Editor];
        }

        if ($inviter->isAdmin()) {
            return [UserRole::Editor];
        }

        return [];
    }

    public function inviter(): BelongsTo
    {
        return $this->belongsTo(self::class, 'invited_by');
    }

    public function userPermissions(): HasMany
    {
        return $this->hasMany(UserPermission::class);
    }

    public function hasPermission(string $code): bool
    {
        $permission = Permission::query()->where('code', $code)->first();
        if (! $permission) {
            return false;
        }

        $override = $this->userPermissions()
            ->where('permission_id', $permission->id)
            ->first();

        if ($override !== null) {
            return $override->effect === 'allow';
        }

        // Éditeur avec permissions déléguées : uniquement les droits explicitement accordés.
        if ($this->isEditor() && $this->userPermissions()->exists()) {
            return false;
        }

        return RolePermission::query()
            ->where('role', $this->role)
            ->where('permission_id', $permission->id)
            ->exists();
    }
}
