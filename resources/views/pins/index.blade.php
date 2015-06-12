@extends('layouts.app')

@section('content')
	@foreach($pins as $pin)
		<h2><a href="{{ route('pins.show', $pin->id) }}">{{ $pin->title }}</a></h2>
	@endforeach
@stop