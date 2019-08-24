<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\MessageEvent;

class MessageController extends Controller
{
    public function index()
    {
        $searched = request()->query('search');
        if($searched){
            $search =  User::where('username', 'LIKE', '%'. $searched .'%')->get();
        }
        return view('messages', compact('search'));
    }


    public function show($id)
    {
        $searched = request()->query('search');
        if($searched){
            $search =  User::where('username', 'LIKE', '%'. $searched .'%')->get();
        }
        $user = User::findOrFail($id);
        return view('messages', compact('user', 'search'));
    }



    public function get($id)
    {
        $user = User::findOrFail($id);
        return auth()->user()->getMessages($user)->latest()->paginate(2);
    }



    public function store(Request $request)
    {
        $message =  Message::create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
            'reciver_id' => $request->reciver
        ]);
        
        broadcast(new MessageEvent($message))->toOthers();

        return $message;
    }
}
