@extends('layouts.app')


@section('content')
	@forelse($pins as $pin)
		<a href="{{ route('pins.show', $pin->id) }}">
			<img src="{{ $pin->image }}" alt="">
		</a>
		<h2>{!! link_to_route('pins.show', $pin->title, $pin->id) !!}</h2>
	@empty
		<p>No pins available at this moment.</p>
	@endforelse
@stop