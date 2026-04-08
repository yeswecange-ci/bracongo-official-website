<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageBoutique extends Model
{
    protected $table = 'page_boutique';

    protected $fillable = [
        'hero_image',
        'hero_badge',
        'hero_titre',
        'hero_description',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
