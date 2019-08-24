<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // orWhere('id', "<>", auth()->user()->id)->
        // dd(auth()->user()->following()->pluck('friend_id'));
        return User::whereNotIn('id', auth()->user()->following()->pluck('friend_id'))
        ->orWhere('id', "<>", auth()->user()->id)->inRandomOrder()->take(3)->get();
    }
    
}
