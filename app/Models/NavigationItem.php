<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class NavigationItem extends Model
{
    protected $table = 'navigation_items';

    protected $fillable = ['label', 'url', 'ordre', 'parent_id', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    protected static function booted(): void
    {
        $flush = function () {
            Cache::forget('front.nav_items');
            Cache::forget('front.search_data');
        };
        static::saved($flush);
        static::deleted($flush);
    }

    public function parent()
    {
        return $this->belongsTo(NavigationItem::class, 'parent_id');
    }

    public function enfants()
    {
        return $this->hasMany(NavigationItem::class, 'parent_id')->orderBy('ordre');
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_id')->orderBy('ordre');
    }

    public function scopeActifs($query)
    {
        return $query->where('is_active', true);
    }
}
