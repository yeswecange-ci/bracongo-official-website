<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produits';

    protected $fillable = [
        'nom', 'slug', 'description', 'image', 'prix', 'stock',
        'reference', 'ordre', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'prix' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function scopeActifs($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }
}
