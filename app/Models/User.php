<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo_url',
        'cover_photo_url',
        'level_id',
        'role_id',
        'status_id',
        'gender',
        'phone_number',
        'birthday',
        'about'
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
        'birthday'          => 'datetime',
        'level_id'          => 'integer',
        'role_id'           => 'integer',
        'status_id'         => 'integer',
    ];

    /**
     *
     * @var array
     */
    protected $with = ['socialAccount', 'role', 'country'];

    /**
     *
     * @var array
     */
    protected $attributes = [
        'level_id'      => 1,
        'role_id'       => 1,
        'status_id'     => 1,
    ];

    protected $appends = ['phrases_count', 'contributor_points'];

    /**
     * Get the key name for route model binding.
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function socialAccount()
    {
        return $this->hasOne(SocialAccount::class);
    }

    /**
     * Relationship between User and Phrasebook (creator).
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phrases()
    {
        return $this->hasMany(Phrasebook::class, 'created_by');
    }

    /**
     * Relationship between a User and Discussion.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    /**
     * Relationship between a User and Reply.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Relationship between a User and Level.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Relationship between a User and PhrasebookCategory.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(PhrasebookCategory::class);
    }

    /**
     * Relationship between a User and Conversations.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_to_user');
    }

    /**
     * Relationship between a User and Role.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getPhrasesCountAttribute()
    {
        return $this->phrases()->count();
    }

    public function getContributorPointsAttribute()
    {
        return 0; // need to some logic.
    }

    /**
     * Relationship between a User and Country.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
