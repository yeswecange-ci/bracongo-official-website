<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $table = 'hero_slides';

    protected $fillable = ['image', 'alt', 'ordre', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActifs($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }
}
