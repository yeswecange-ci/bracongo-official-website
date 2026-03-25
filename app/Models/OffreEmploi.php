<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OffreEmploi extends Model
{
    protected $table = 'offres_emploi';

    protected $fillable = ['titre', 'description', 'image', 'lien', 'is_active', 'ordre'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActives($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }
}
