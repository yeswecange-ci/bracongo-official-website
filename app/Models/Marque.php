<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marque extends Model
{
    protected $table = 'marques';

    protected $fillable = [
        'nom', 'slug', 'description', 'image',
        'lien', 'video_urls', 'ordre', 'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'video_urls' => 'array',
    ];

    public function boissons(): HasMany
    {
        return $this->hasMany(Boisson::class)->orderBy('ordre');
    }

    public function scopeActives($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }

    /**
     * Libellés des catégories actives indexés par slug (gérées au back-office).
     *
     * @return array<string, string>
     */
    public static function categories(): array
    {
        return Categorie::options();
    }
}
