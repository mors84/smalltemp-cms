<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title',
    ];

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;


    // DEFINING ELOQUENT RELATIONSHIPS
    public function user(){
        return $this->morphedByMany(User::class, 'social_media_link');
    }
}
