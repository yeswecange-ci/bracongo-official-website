<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FooterSettings extends Model
{
    protected $table = 'footer_settings';

    protected $fillable = [
        'mission_texte', 'adresse', 'telephone', 'email',
        'certification_image', 'copyright_debut_annee',
    ];

    protected static function booted(): void
    {
        $flush = fn () => Cache::forget('front.footer_config');
        static::saved($flush);
        static::deleted($flush);
    }

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
