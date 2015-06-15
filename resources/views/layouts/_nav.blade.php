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
    <div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
					<li>{!! link_to_route('pins.create', 'New Pin') !!}</li>
					<li>{!! link_to_route('favorites_path', 'Favorites', Auth::id()) !!}</li>
					<li>{!! link_to_route('user_edit_path', 'Account') !!}</li>
					<li>{!! link_to('auth/logout', 'Sign Out') !!}</li>
				@else
					<li>{!! link_to('auth/register', 'Sign Up') !!}</li>
					<li>{!! link_to('auth/login', 'Sign In') !!}</li>
				@endif
			</ul>
    </div>
	</div>
</nav>