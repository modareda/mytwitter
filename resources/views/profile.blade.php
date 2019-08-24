@extends('layouts.main')

@section('content')

    <div class="userprofile mt-3 mb-3">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="{{asset('images/img_avatar3.png')}}" class="img-fluid mr-2 img" alt="Cinque Terre">
                        <a href="">{{$user->name}} <span class="text-muted small"><span>@</span>{{$user->username}}</span></a> 
                    </div>
                    <div class="m-2">
                        @if($user->id != auth()->user()->id)
                            {{-- <div class="btn btn-outline-primary btn-sm borderRound"><i class="far fa-envelope"></i></div> --}}
                            <follow :tofollow="{{$user}}" :ifollow="{{Auth::user()->following}}"></follow>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text text-break">
                    <div class="text-muted mb-2">Joined {{$user->created_at->diffForHumans()}}</div>
                    <a href="" class="d-inline-block mr-2"><dt>Followers  {{$user->followers()->count()}}</dt></a>
                    <a href="" class="d-inline-block ml-1"><dt>Following {{$user->following->count()}}</dt></a>
                </p>
            </div>
        </div>
    </div>

    <post :user="{{Auth::user()}}" :postat="{{json_encode($posts)}}"></post>

@endsection
