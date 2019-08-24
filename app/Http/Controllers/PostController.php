<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\posts\StoreRequest;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::latest()->paginate(10);
        if(auth()->user()->following->count() > 0) {
            $posts = Post::whereIn('user_id', auth()->user()->following()->pluck('friend_id'))->latest()->paginate(10);
        } else {
            $posts = Post::firstOrFail()->paginate(1);
        }
        if($posts->onFirstPage()){
            return view('home', compact('posts'));
        }
        return $posts;
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function store(StoreRequest $request)
    {
        return auth()->user()->posts()->create([
            'body' => $request->body,
            'post_id' => $request->postid
        ])->fresh();
    }


    public function delete($id)
    {
        Post::findOrFail($id)->delete();
    }
}
