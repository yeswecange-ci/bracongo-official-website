<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageContactReply extends Model
{
    protected $fillable = [
        'message_contact_id',
        'user_id',
        'body',
    ];

    public function messageContact(): BelongsTo
    {
        return $this->belongsTo(MessageContact::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
