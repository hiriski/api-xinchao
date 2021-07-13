<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id', 'conversation_type'
    ];

    protected $with = ['participants'];

    protected $appends = [
        'last_message'
    ];

    protected $attributes = [
        'conversation_type' => 'private'
    ];

    public function getLastMessageAttribute()
    {
        return $this->messages->last();
    }

    /**
     * Relation between Conversation and Message.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Relation between Conversation to User.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'conversation_to_user');
    }
}
