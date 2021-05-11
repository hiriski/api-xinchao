<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhrasebookCategory extends Model {
    use HasFactory;

    protected $fillable = [
        'id_ID',
        'vi_VN',
        'en_US',
        'description',
        'color_id',
        'icon_name',
        'icon_type',
        'user_id',
    ];

    /** Disable for attribute timestamps */
    public $timestamps = false;

    /**
     * Eager load for every query.
     * @var array
     */
    protected $with = [
        'color'
    ];

    protected $attributes = [
        'icon_type'   => 'eva',
    ];

    /**
     * Relationship between a PhrasebookCategory and Phrasebook.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phrases() {
        return $this->hasMany(Phrasebook::class, 'category_id');
    }

    /**
     * Relations between a PhrasebookCategory and Color.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color() {
        return $this->belongsTo(Color::class, 'color_id');
    }

    /**
     * Relations between a PhrasebookCategory and User.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
