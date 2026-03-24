<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParametresSite extends Model
{
    protected $table = 'parametres_site';

    protected $fillable = [
        'logo', 'favicon', 'couleur_principale', 'search_suggestions',
        'actualites_hero_titre', 'actualites_filtre_tout_label',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
