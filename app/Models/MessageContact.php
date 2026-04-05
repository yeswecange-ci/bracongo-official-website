<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MessageContact extends Model
{
    protected $table = 'messages_contact';

    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'lu'];

    protected $casts = ['lu' => 'boolean'];

    public function scopeNonLus($query)
    {
        return $query->where('lu', false);
    }

    public function sentReplies(): HasMany
    {
        return $this->hasMany(MessageContactReply::class);
    }
}
