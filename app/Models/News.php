<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'titre', 'slug', 'type', 'extrait', 'contenu', 'image',
        'lien_externe', 'date_publication', 'date_evenement', 'lieu',
        'ordre', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'date_publication' => 'date',
        'date_evenement' => 'date',
    ];

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
