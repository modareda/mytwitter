<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->latest()->paginate(10);
        if($posts->onFirstPage()){
            return view('profile', compact('posts', 'user'));
        }
        return $posts;
    }
}
