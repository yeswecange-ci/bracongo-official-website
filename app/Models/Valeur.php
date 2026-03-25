<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valeur extends Model
{
    protected $table = 'valeurs';

    protected $fillable = ['lettre', 'description', 'ordre'];

    public function scopeOrdonnes($query)
    {
        return $query->orderBy('ordre');
    }
}
