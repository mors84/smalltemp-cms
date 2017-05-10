<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_active', 'author', 'email', 'content', 'comment_id',
    ];

    public function getGravatarAttribute() {
        $defaultGravatar = urlencode(public_path().'/images/avatar-default.png');
        $hashEmail = md5(strtolower(trim($this->attributes['email']))) . "?s=160&d=".$defaultGravatar;

        return "http://www.gravatar.com/avatar/".$hashEmail;
    }


    // DEFINING ELOQUENT RELATIONSHIPS
    public function comment() {
        return $this->belongsTo(Comment::class);
    }
    public function votes() {
        return $this->morphMany(Vote::class, 'votetable');
    }
}
