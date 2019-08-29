<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\like;
use App\Notifications\Like as AppLike;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        $post->user->notify(new AppLike(auth()->user()));

        $post->likes()->create([
            'user_id' => auth()->user()->id
        ]);
        // like::attach(auth()->user()->id, $post->id);

    }

    public function unlike(Post $post)
    {
        like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->delete();
    }
}
