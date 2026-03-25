<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageWelcome extends Model
{
    protected $table = 'page_welcome';

    protected $fillable = [
        'fond_image', 'titre', 'texte_avertissement',
        'btn_majeur_texte', 'btn_mineur_texte', 'message_refus',
        'mention_legale',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
