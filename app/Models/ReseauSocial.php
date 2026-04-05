<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ReseauSocial extends Model
{
    protected $table = 'reseaux_sociaux';

    protected $fillable = ['platform', 'url', 'is_active', 'ordre'];

    protected $casts = ['is_active' => 'boolean'];

    protected static function booted(): void
    {
        $flush = fn () => Cache::forget('front.reseaux');
        static::saved($flush);
        static::deleted($flush);
    }

    public function scopeActifs($query)
    {
        return $query->where('is_active', true)->orderBy('ordre');
    }
}
