<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSettings extends Model
{
    protected $table = 'footer_settings';

    protected $fillable = [
        'mission_texte', 'adresse', 'telephone', 'email',
        'certification_image', 'copyright_debut_annee',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
