<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowController extends Controller
{
    public function follow($id)
    {
        $user = User::findOrFail($id);
        auth()->user()->follow($user);
    }
    public function unfollow($id)
    {
        $user = User::findOrFail($id);
        auth()->user()->unfollow($user);
    }
}
