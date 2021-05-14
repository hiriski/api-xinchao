<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'text',
        'audio_url',
        'image_url',
        'caption',
    ];

    /**
     * eager load for every query.
     * @var array
     */
    protected $with = ['user'];

    /**
     * Relation between Message and User.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relation between Message and Conversation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation() {
        return $this->belongsTo(Conversation::class);
    }
}
