<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['socialAccount'];

    /**
     * Get the key name for route model binding
     * @return string
     */
    public function getRouteKeyName() {
        return 'username';
    }

    public function socialAccount() {
        return $this->hasOne(SocialAccount::class);
    }

    /**
     * Relationship between User and Phrasebook 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phrases() {
        return $this->hasMany(
            Phrasebook::class,
            'created_by'
        );
    }

    /**
     * Relationship between a User and Discussion 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discussions() {
        return $this->hasMany(Discussion::class);
    }

    /**
     * Relationship between a User and Reply 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies() {
        return $this->hasMany(Reply::class);
    }
}
