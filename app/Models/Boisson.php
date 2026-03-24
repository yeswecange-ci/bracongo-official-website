<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Boisson extends Model
{
    protected $table = 'boissons';

    protected $fillable = [
        'marque_id', 'nom', 'slug', 'description',
        'hero_image', 'image', 'logo',
        'annee_lancement', 'ingredients', 'type', 'taux_alcool',
        'conditionnement', 'slogan', 'ddm', 'type_bouteille',
        'positionnement', 'coeur_cible', 'video_urls',
        'ordre', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'video_urls' => 'array',
        'annee_lancement' => 'integer',
    ];

    public function marque(): BelongsTo
    {
        return $this->belongsTo(Marque::class);
    }

    public function scopeActives($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }
}
