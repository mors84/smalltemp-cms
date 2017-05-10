<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alt', 'title',
    ];

    /**
    * File path to photo.
    *
    * @var string
    */
    protected $uploads = '/images/';

    /**
 	 * Get path url to photo.
 	 *
	 */
    public function getPathAttribute($photo)
    {
        return $this->uploads . $photo;
    }



    // DEFINING ELOQUENT RELATIONSHIPS
    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function sizes() {
        return $this->hasMany(PhotoSize::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function ratings() {
        return $this->morphToMany(Star::class, 'rating');
    }
    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function user(){
        return $this->hasOne(User::class);
    }
}
