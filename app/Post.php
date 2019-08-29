<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $with = ['user', 'likes', 'comments'];
    protected $fillable = ['user_id', 'body', 'image_url', 'post_id'];
    protected $appends = ['likescount', 'isLiked'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(like::class);
    }

    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function isLiked()
    {
        return $this->likes()->where('user_id',  auth()->user()->id)->count() > 0;
    }
    public function getisLikedAttribute()
    {
        return $this->isLiked();
    }
}
