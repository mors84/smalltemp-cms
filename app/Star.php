<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'name',
    ];

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;


    // DEFINING ELOQUENT RELATIONSHIPS
    public function photo(){
        return $this->morphedByMany(Photo::class, 'rating');
    }
    public function post(){
        return $this->morphedByMany(Post::class, 'rating');
    }
}
