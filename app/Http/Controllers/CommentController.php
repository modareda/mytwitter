<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class CommentController extends Controller
{
    public function store(Request $requet, Post $post)
    {
        $requet->validate([
            'comment' => 'required'
        ]);

        return $post->comments()->create([
            'comment' => $requet->comment,
            'user_id' => auth()->user()->id,
            'comment_id' => $requet->comment_id
        ])->fresh();

    }
}
