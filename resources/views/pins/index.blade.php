@extends('layouts.app')

@section('content')
	<div id="pins" class="masonry">
		@forelse($pins as $pin)
			<div class="box panel panel-default">
				<a href="{{ route('pins.show', $pin->id) }}" class="darken">
					<img src="{{ GlideImage::load('pins/'.$pin->image) }}" />
				</a>
				<h2>
					{!! link_to_route('pins.show', $pin->title, $pin->id) !!}
				</h2>
				<p class="user">
					Submitted by {{ $pin->owner->name }}
				</p>
			</div>
		@empty
			<p>No pins available at this moment.</p>
		@endforelse
	</div>

	<div class="row">
		<div class="col-md-12 text-center">
			{!! $pins->render() !!}
		</div>
	</div>
@stop