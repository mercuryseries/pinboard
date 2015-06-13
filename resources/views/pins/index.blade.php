@extends('layouts.app')


@section('content')
	{!! link_to_route('pins.create', 'Create a new pin', [], ['class' => 'btn btn-primary']) !!}</h2>

	<hr/>

	@forelse($pins as $pin)
		<h2>{!! link_to_route('pins.show', $pin->title, $pin->id) !!}</h2>
	@empty
		<p>No pins available at this moment.</p>
	@endforelse
@stop