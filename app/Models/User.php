<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
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
        'avatar',
        'password',
        'role',
        'status',
        'invited_by',
        'last_login_at',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'two_factor_exempt',
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
            'two_factor_secret' => 'encrypted',
            'two_factor_recovery_codes' => 'encrypted:array',
            'two_factor_confirmed_at' => 'datetime',
            'two_factor_exempt' => 'boolean',
            'last_login_at' => 'datetime',
            'status' => UserStatus::class,
        ];
    }

    public function hasTwoFactorEnabled(): bool
    {
        return $this->two_factor_confirmed_at !== null
            && $this->two_factor_secret !== null
            && $this->two_factor_secret !== '';
    }

    public function isTwoFactorExempt(): bool
    {
        return $this->two_factor_exempt === true;
    }

    public function hasSatisfiedBackOfficeTwoFactorRequirement(): bool
    {
        return $this->hasTwoFactorEnabled() || $this->isTwoFactorExempt();
    }

    public function hasTwoFactorPendingSetup(): bool
    {
        if ($this->isTwoFactorExempt()) {
            return false;
        }

        return $this->two_factor_secret !== null
            && $this->two_factor_secret !== ''
            && $this->two_factor_confirmed_at === null;
    }

    public function scopeVisibleInAdminUserList(Builder $query): Builder
    {
        return $query->where('two_factor_exempt', false);
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

    public function isAdministration(): bool
    {
        return $this->isSuperAdmin() || $this->isAdmin();
    }

    public function isEditor(): bool
    {
        return $this->role === UserRole::Editor->value;
    }

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

    public function avatarUrl(): string
    {
        if ($this->avatar !== null && $this->avatar !== '' && is_file(public_path($this->avatar))) {
            return asset($this->avatar);
        }

        return asset('admin/images/user.jpg');
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

        if ($this->isEditor() && $this->userPermissions()->exists()) {
            return false;
        }

        return RolePermission::query()
            ->where('role', $this->role)
            ->where('permission_id', $permission->id)
            ->exists();
    }
}
