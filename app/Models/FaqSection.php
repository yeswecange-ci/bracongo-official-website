<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FaqSection extends Model
{
    protected $table = 'faq_sections';

    /**
     * Icônes proposées au back-office : clé stockée en base => libellé + tracé
     * SVG (attribut `d`). On stocke une clé plutôt que le SVG brut afin que le
     * rédacteur n'ait jamais à manipuler de code.
     *
     * @var array<string, array{label: string, path: string}>
     */
    public const ICONES = [
        'batiment' => [
            'label' => 'Entreprise / bâtiment',
            'path' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 00-1-1h-2a1 1 0 00-1 1v5m4 0H9',
        ],
        'produits' => [
            'label' => 'Produits / catalogue',
            'path' => 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18',
        ],
        'livraison' => [
            'label' => 'Commandes / distribution',
            'path' => 'M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z',
        ],
        'mobile' => [
            'label' => 'Application mobile',
            'path' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
        ],
        'carriere' => [
            'label' => 'Carrière / recrutement',
            'path' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
        ],
        'contact' => [
            'label' => 'Contact / e-mail',
            'path' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
        ],
        'question' => [
            'label' => 'Point d\'interrogation',
            'path' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
        'info' => [
            'label' => 'Information',
            'path' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
    ];

    public const ICONE_DEFAUT = 'question';

    protected $fillable = ['titre', 'icone', 'ordre', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(FaqQuestion::class)->orderBy('ordre');
    }

    public function questionsActives(): HasMany
    {
        return $this->questions()->where('is_active', true);
    }

    public function scopeActives($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }

    /** Tracé SVG de l'icône choisie (repli sur l'icône par défaut). */
    public function iconePath(): string
    {
        return self::ICONES[$this->icone]['path'] ?? self::ICONES[self::ICONE_DEFAUT]['path'];
    }

    /**
     * Libellés des icônes disponibles, pour les listes déroulantes.
     *
     * @return array<string, string>
     */
    public static function iconeOptions(): array
    {
        return array_map(fn (array $icone) => $icone['label'], self::ICONES);
    }
}
