<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagePro extends Model
{
    protected $table = 'page_pro';

    protected $fillable = [
        'hero_image', 'hero_titre', 'description',
        'pourquoi_titre', 'pourquoi_intro', 'pourquoi_items',
        'fonctionnalites_titre', 'fonctionnalites_items',
        'app_image', 'cta_texte', 'cta_lien', 'pdf_lien',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
