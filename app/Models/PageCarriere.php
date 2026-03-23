<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageCarriere extends Model
{
    protected $table = 'page_carriere';

    protected $fillable = ['hero_image', 'texte_intro'];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
