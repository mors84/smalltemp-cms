<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoSize extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo_id', 'path', 'width',
    ];

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;

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
    public function photo(){
        return $this->belongsTo(Photo::class);
    }
}
