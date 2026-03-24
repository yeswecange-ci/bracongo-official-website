<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marque extends Model
{
    protected $table = 'marques';

    protected $fillable = [
        'nom', 'slug', 'description', 'image', 'image_banner',
        'lien', 'ordre', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function boissons(): HasMany
    {
        return $this->hasMany(Boisson::class)->orderBy('ordre');
    }

    public function scopeActives($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }

    public static function categories(): array
    {
        return [
            'bieres' => 'Bières',
            'gazeuses' => 'Boissons gazeuses',
            'eaux' => 'Eaux',
            'energisantes' => 'Boissons énergisantes',
        ];
    }
}
