<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_ID',
        'vi_VN',
        'en_US',
        'description',
        'slug',
        'color_id',
        'icon_name',
        'icon_type',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
