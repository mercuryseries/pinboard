<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $title or 'pinboard' }}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        {!! link_to_route('root_path', 'Pin Board', [], ['class' => 'navbar-brand']) !!}
      </div>
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
					<li>{!! link_to_route('pins.create', 'New Pin') !!}</li>
					<li>{!! link_to('#', 'Account') !!}</li>
					<li>{!! link_to('auth/logout', 'Sign Out') !!}</li>
				@else
					<li>{!! link_to('auth/register', 'Sign Up') !!}</li>
					<li>{!! link_to('auth/login', 'Sign In') !!}</li>
				@endif
			</ul>
		</div>
	</nav>

	<div class="container">
		@include('flash::message')

		@yield('content')
	</div>

	<script src="{{ asset('/js/all.js') }}"></script>
</body>
</html>