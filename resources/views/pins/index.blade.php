@extends('layouts.app')


@section('content')
	<div id="pins" class="masonry">
	@forelse($pins as $pin)
		<div class="box panel panel-default">
			<a href="{{ route('pins.show', $pin->id) }}" class="darken">
				<img src="{{ $pin->originalImage() }}" alt="">
			</a>
			<h2>{!! link_to_route('pins.show', $pin->title, $pin->id) !!}</h2>
			<p class="user">Submitted by {{ $pin->owner->email }}</p>
		</div>
	@empty
	</div>
		<p>No pins available at this moment.</p>
	@endforelse
@stop