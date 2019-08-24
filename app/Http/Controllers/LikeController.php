<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\like;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        if(!auth()->user()->iLikeThisPost($post)){
            return $post->likes()->create([
                'user_id' => auth()->user()->id
            ])->fresh();
        } else {
            like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->delete();
        }
    }
}
