<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Favoritable;

class Discussion extends Model {
    use HasFactory, SoftDeletes, Favoritable;

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'content',
        'topic_id',
        'user_id',
        'hits',
    ];

    /**
     * eager load relationship for every query
     * @var array
     */
    protected $with = ['user', 'topic'];

    /**
     * Appends custom attributes
     * @var array
     */
    protected $appends = ['replies_count', 'is_favorited'];

    /**
     * Relationship between Discussion and User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship between Discussion and Topic
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic() {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Relationship between Discussion and Reply
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function replies() {
        return $this->hasMany(Reply::class);
    }
    
    /**
     * Get the replies count for thread discussion.
     * @return bool
     */
    public function getRepliesCountAttribute() {
        return $this->replies->count();
    }
}



