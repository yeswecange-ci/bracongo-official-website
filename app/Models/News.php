<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'titre', 'slug', 'type', 'extrait', 'contenu', 'image',
        'gallery_images', 'youtube_urls',
        'lien_externe', 'whatsapp_url', 'whatsapp_label', 'date_publication', 'date_evenement', 'lieu',
        'ordre', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'date_publication' => 'date',
        'date_evenement' => 'date',
        'gallery_images' => 'array',
        'youtube_urls' => 'array',
    ];

    protected static function booted(): void
    {
        $flush = fn () => Cache::forget('front.search_data');
        static::saved($flush);
        static::deleted($flush);
    }

    public function scopeActives($query)
    {
        return $query->where('is_active', true)->orderBy('date_publication', 'desc')->orderBy('ordre');
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public static function types(): array
    {
        return [
            'actualites' => 'Actualités',
            'evenements' => 'Événements',
            'activations' => 'Activations',
            'sponsoring' => 'Sponsoring',
            'communiques' => 'Communiqués',
            'mediatheque' => 'Médiathèque',
        ];
    }
}
