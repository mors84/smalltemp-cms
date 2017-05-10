<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'password', 'url', 'description', 'is_active', 'role_id', 'photo_id', 'facebook_id', 'twitter_id',
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
 	 * The function check role.
 	 *
 	 * @return bool
	 */
    public function isAdmin()
    {
        if (isset($this->role->name)) {
            if ($this->role->name == 'administrator' && $this->is_active == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }


    // DEFINING ELOQUENT RELATIONSHIPS
    public function role() {
        return $this->belongsTo(Role::class);
    }
    public function photo() {
        return $this->belongsTo(Photo::class);
    }
    public function posts() {
        return $this->hasMany(Post::class);
    }
    public function socialMediaLinks() {
        return $this->morphToMany(SocialMedia::class, 'social_media_link')->withPivot('profile_link');
    }
}
