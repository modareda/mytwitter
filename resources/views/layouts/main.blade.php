<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    
	<!-- Styles -->
	<link rel="stylesheet" href="{{asset('css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	
</head>
<body>
	<div id="app">
		<div class="container-fluid">
			<div class="row">
				<div class="col col-md-3">
					<ul class="list-group mainList" style="position:fixed">
						<a href="#" ><li class="bigBold giveColour logo"><i class="fab fa-twitter fa-2x"></i></li></a>
						<a href="{{route('home')}}" class="bigBold"><li><i class="fas fa-home"></i>  <span class="pl-2">Home</span></li></a>
						<a href="#" class="bigBold"><li><i class="fas fa-hashtag"></i> <span class="pl-2">Explore</span></li></a>
						<a href="#" class="bigBold"><li><i class="far fa-bell"></i> <span class="pl-2">Notification <div class="badge badge-danger">{{auth()->user()->unreadNotifications()->count()}}</div></span></li></a>
						<a href="{{route('messanger')}}" class="bigBold"><li><i class="far fa-envelope"></i> <span class="pl-2">Messages</span></li></a>
						<a href="{{route('profile', Auth::user()->id)}}" class="bigBold"><li><i class="fas fa-user"></i> <span class="pl-2">{{Auth::user()->username}}</span></li></a>
						<a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="bigBold">
							<li><i class="fas fa-sign-out-alt"></i> <span class="pl-2">Logout</span></li></a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</ul>
				</div>
				<div class="col col-md-6 giveBorderLeftRight p-0">
					@yield('content')
				</div>
				<div class="col col-md-3">
					@yield('search')
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	
	<script src="{{asset('js/jquery.js')}}"></script>
	<script src="{{asset('js/all.min.js')}}"></script>
    {{-- <script src="{{asset('js/popper.min.js')}}"></script> --}}
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>