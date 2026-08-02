<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Categorie extends Model
{
    protected $table = 'categories';

    /**
     * Slug de la catégorie « système » : la page front des bières est une vue
     * dédiée (/Nos-marques-bieres, contenu géré via Page Nos bières). Cette
     * catégorie ne peut être ni supprimée ni renommée (slug).
     */
    public const SLUG_BIERES = 'bieres';

    protected $fillable = [
        'nom', 'slug', 'ordre', 'is_active',
        'hero_image', 'hero_titre', 'hero_image_alt',
        'breadcrumb_libelle', 'meta_title',
        'search_placeholder', 'message_liste_vide', 'message_recherche_vide',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        $flush = function (): void {
            Cache::forget('front.categories');
            Cache::forget('front.search_data');
        };
        static::saved($flush);
        static::deleted($flush);
    }

    public function boissons(): HasMany
    {
        return $this->hasMany(Boisson::class, 'categorie', 'slug');
    }

    public function scopeActives($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }

    /**
     * Libellés des catégories actives, indexés par slug (dans l'ordre défini
     * au back-office). Fallback statique si la table n'existe pas encore
     * (ex. déploiement avant migration).
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        try {
            return Cache::rememberForever(
                'front.categories',
                fn () => static::actives()->pluck('nom', 'slug')->all()
            );
        } catch (\Throwable) {
            return [
                'bieres' => 'Bières',
                'gazeuses' => 'Boissons gazeuses',
                'eaux' => 'Eaux',
                'eaux-gazeuses' => 'Eaux gazeuses',
                'energisantes' => 'Boissons énergisantes',
            ];
        }
    }

    public function titreOnglet(): string
    {
        if ($this->meta_title) {
            return $this->meta_title;
        }

        return 'Nos Marques – '.($this->breadcrumb_libelle ?: $this->nom);
    }

    public function estBieres(): bool
    {
        return $this->slug === self::SLUG_BIERES;
    }
}
