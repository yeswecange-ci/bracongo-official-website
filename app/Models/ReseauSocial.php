<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReseauSocial extends Model
{
    protected $table = 'reseaux_sociaux';

    protected $fillable = ['platform', 'url', 'is_active', 'ordre'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActifs($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }
}
