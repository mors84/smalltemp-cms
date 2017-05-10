<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'slug', 'is_active', 'user_id', 'category_id', 'metadata_id', 'photo_id',
    ];

    /**
 	 * Change value to slug.
	 */
    public function setSlugAttribute($value)
    {
        if (empty($value)) {
            $value = str_slug($this->attributes['title']);
        } else {
            $value = str_slug($value);
        }

        $this->attributes['slug'] = $value;
    }


    // DEFINING ELOQUENT RELATIONSHIPS
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function metadata() {
        return $this->belongsTo(Metadata::class);
    }
    public function photo() {
        return $this->belongsTo(Photo::class);
    }
    public function ratings() {
        return $this->morphToMany(Star::class, 'rating');
    }
    public function tags() {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votetable');
    }
}
