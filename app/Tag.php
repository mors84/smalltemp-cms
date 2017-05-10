<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'metadata_id',
    ];


    // DEFINING ELOQUENT RELATIONSHIPS
    public function metadata() {
        return $this->belongsTo(Metadata::class);
    }
    public function photos(){
        return $this->morphedByMany(Photo::class, 'taggable');
    }
    public function posts(){
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
