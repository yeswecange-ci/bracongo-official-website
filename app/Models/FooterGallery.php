<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterGallery extends Model
{
    protected $table = 'footer_gallery';

    protected $fillable = ['image', 'alt', 'ordre'];

    public function scopeOrdonnes($query)
    {
        return $query->orderBy('ordre');
    }
}
