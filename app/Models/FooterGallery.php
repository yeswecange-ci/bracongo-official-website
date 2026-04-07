<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FooterGallery extends Model
{
    protected $table = 'footer_gallery';

    protected $fillable = ['image', 'alt', 'ordre'];

    protected static function booted(): void
    {
        $flush = fn () => Cache::forget('front.footer_gallery');
        static::saved($flush);
        static::deleted($flush);
    }

    public function scopeOrdonnes($query)
    {
        return $query->orderBy('ordre');
    }
}
