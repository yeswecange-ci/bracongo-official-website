<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageContact extends Model
{
    protected $table = 'messages_contact';

    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'lu'];

    protected $casts = ['lu' => 'boolean'];

    public function scopeNonLus($query)
    {
        return $query->where('lu', false);
    }
}
