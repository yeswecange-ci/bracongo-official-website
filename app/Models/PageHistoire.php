<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageHistoire extends Model
{
    protected $table = 'page_histoire';

    protected $fillable = [
        'hero_image', 'titre', 'paragraphe_1', 'paragraphe_2', 'paragraphe_3',
        'image_brasserie', 'valeurs_titre',
        'rse_titre', 'rse_texte', 'rse_image', 'rse_cta_texte', 'rse_cta_lien',
        'presence_titre', 'maps_embed_url', 'carte_panel_titre', 'presence_note',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
