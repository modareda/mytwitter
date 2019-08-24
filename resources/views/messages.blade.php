@extends('layouts.message')


@section('friends')
@if(!empty($search))
@foreach ($search as $s)
    <a href="{{route('message', $s->id)}}">
        <div class="chat_list">
                <div class="chat_people">
                <div class="chat_img"> <img src="{{asset('images/img_avatar3.png')}}" alt="sunil"> </div>
                <div class="chat_ib">
                    <h5>{{$s->name}}</h5>
                </div>
                </div>
        </div>
    </a>
@endforeach
@endif

@foreach (auth()->user()->following as $friend)
{{-- @php
    $lastMessage = auth()->user()->getLastMessage($friend);    
@endphp --}}
    <a href="{{route('message', $friend->id)}}">
        <div class="chat_list">
                <div class="chat_people">
                <div class="chat_img"> <img src="{{asset('images/img_avatar3.png')}}" alt="sunil"> </div>
                <div class="chat_ib">
                    <h5>{{$friend->name}} <span class="chat_date">Last Message Time</span></h5>
                </div>
                </div>
        </div>
    </a>
@endforeach
    
@endsection

@section('content')

    @if (!empty($user))
        <send :user="{{Auth::user()}}" :friend="{{$user}}"></send>        
    @endif

@endsection
