<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageEaux extends Model
{
    protected $table = 'page_eaux';

    protected $fillable = [
        'hero_image',
        'hero_titre',
        'hero_image_alt',
        'breadcrumb_libelle',
        'meta_title',
        'search_placeholder',
        'message_liste_vide',
        'message_recherche_vide',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    public function titreOnglet(): string
    {
        if ($this->meta_title) {
            return $this->meta_title;
        }

        return 'Nos Marques – '.$this->breadcrumb_libelle;
    }
}
