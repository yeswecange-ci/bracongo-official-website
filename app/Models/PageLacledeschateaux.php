<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PageLacledeschateaux extends Model
{
    protected $table = 'page_lacledeschateaux';

    protected $fillable = [
        'hero_image',
        'hero_titre',
        'paragraphe_1',
        'paragraphe_2',
        'horaire',
        'adresse',
        'telephone',
        'email',
        'cta_libelle',
        'cta_url',
        'selection_titre',
        'selection_texte',
        'services_titre',
        'services_html',
    ];

    protected static function booted(): void
    {
        $flush = fn () => Cache::forget('front.search_data');
        static::saved($flush);
        static::deleted($flush);
    }

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
