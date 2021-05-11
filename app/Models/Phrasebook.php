<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Favoritable;

class Phrasebook extends Model {
    use HasFactory, SoftDeletes, Favoritable;

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'vi_VN',
        'id_ID',
        'en_US',
        'notes',
        'created_by',
        'updated_by',
        'category_id'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'category_id'  => 'integer',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'category_id'  => 1, // Uncategory
    ];

    /**
     * Relationship between Phrasebook and User (created_by)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
    * Relationship between Phrasebook and User (updated_by)
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function updator() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Relationship between Phrasebook and Category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(PhrasebookCategory::class);
    }

}
