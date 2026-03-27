<?php

namespace App\Models;

use App\Enums\InvitationExpiresHours;
use Illuminate\Database\Eloquent\Model;

class ParametresSite extends Model
{
    protected $table = 'parametres_site';

    protected $fillable = [
        'logo', 'favicon', 'couleur_principale', 'search_suggestions',
        'actualites_hero_titre', 'actualites_filtre_tout_label',
        'invitation_expires_hours',
    ];

    protected function casts(): array
    {
        return [
            'invitation_expires_hours' => InvitationExpiresHours::class,
        ];
    }

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
