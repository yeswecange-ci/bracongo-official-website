<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContact extends Model
{
    protected $table = 'page_contact';

    protected $fillable = [
        'hero_image', 'denomination', 'adresse', 'bp', 'email',
        'tel_consommateurs', 'tel_fetes', 'tel_fournisseurs', 'tel_cle_chateaux',
        'devenir_client_lien',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
