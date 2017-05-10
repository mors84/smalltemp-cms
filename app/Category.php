<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'metadata_id', 'photo_id',
    ];


    // DEFINING ELOQUENT RELATIONSHIPS
    public function metadata() {
        return $this->belongsTo(Metadata::class);
    }
    public function photo() {
        return $this->belongsTo(Photo::class);
    }
    public function posts() {
        return $this->hasMany(Post::class);
    }
}
