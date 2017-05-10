<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_active', 'author', 'email', 'rating', 'content', 'post_id',
    ];

    public function getGravatarAttribute() {
        $defaultGravatar = urlencode(public_path().'/images/avatar-default.png');
        $hashEmail = md5(strtolower(trim($this->attributes['email']))) . "?s=160&d=".$defaultGravatar;

        return "http://www.gravatar.com/avatar/".$hashEmail;
    }


    // DEFINING ELOQUENT RELATIONSHIPS
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function replies() {
        return $this->hasMany(CommentReply::class);
    }
    public function votes() {
        return $this->morphMany(Vote::class, 'votetable');
    }
}
