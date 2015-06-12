@extends('layouts.app')


@section('content')
	{!! link_to_route('pins.create', 'Create a new pin') !!}</h2>

	@foreach($pins as $pin)
		<h2>{!! link_to_route('pins.show', $pin->title, $pin->id) !!}</h2>
	@endforeach
@stop