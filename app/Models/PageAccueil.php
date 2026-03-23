<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageAccueil extends Model
{
    protected $table = 'page_accueil';

    protected $fillable = [
        'qui_titre', 'qui_texte', 'qui_image_fond', 'qui_cta_texte', 'qui_cta_lien',
        'marques_titre', 'marques_description',
        'rejoignez_titre', 'rejoignez_texte', 'rejoignez_image', 'rejoignez_cta_texte', 'rejoignez_cta_lien',
        'actualites_titre', 'actualites_voir_plus_lien',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
