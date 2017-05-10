<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'keywords',
    ];

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;


    // DEFINING ELOQUENT RELATIONSHIPS
    public function category() {
        return $this->hasOne(Category::class);
    }
    public function post() {
        return $this->hasOne(Post::class);
    }
    public function tag() {
        return $this->hasOne(Tag::class);
    }
}
