<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class OffreEmploi extends Model
{
    protected $table = 'offres_emploi';

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'lieu',
        'type_contrat',
        'date_limite_candidature',
        'image',
        'lien',
        'require_lettre_motivation',
        'is_active',
        'ordre',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'require_lettre_motivation' => 'boolean',
        'date_limite_candidature' => 'date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::saving(function (OffreEmploi $offre) {
            if (filled($offre->slug) || blank($offre->titre)) {
                return;
            }
            $base = Str::slug($offre->titre) ?: 'offre';
            $slug = $base;
            $n = 1;
            while (static::query()
                ->where('slug', $slug)
                ->when($offre->exists, fn ($q) => $q->where('id', '!=', $offre->id))
                ->exists()) {
                $slug = $base.'-'.(++$n);
            }
            $offre->slug = $slug;
        });
    }

    public function scopeActives($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }

    public function candidatures(): HasMany
    {
        return $this->hasMany(CandidatureEmploi::class, 'offre_emploi_id');
    }
}
