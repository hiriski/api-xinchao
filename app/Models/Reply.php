<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Favoritable;

class Reply extends Model {
    use HasFactory, Favoritable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'user_id',
        'discussion_id',
    ];

    /**
     * Eager load relationship for every query
     * 
     * @var array
     */
    protected $with = ['user'];

    /**
     * Appends custom attributes
     * @var array
     */
    protected $appends = ['is_favorited'];

    /**
     * Relationship between Reply and User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship between a Reply and Discussion 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discussion() {
        return $this->belongsTo(Discussion::class);
    }
}
