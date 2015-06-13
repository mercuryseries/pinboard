@extends('layouts.app')

@section('content')
	<img src="{{ $pin->image }}" alt="">
	<h1>{{ $pin->title }}</h1>
	<p>{{ $pin->description }}</p>
	<p>Submitted by {{ $pin->owner->email }}</p>

	{!! link_to_route('root_path', 'Back') !!}
	{!! link_to_route('pins.edit', 'Edit', $pin->id) !!}
	{!! link_to_route('pins.destroy', 'Delete', $pin->id, ['data-method' => 'DELETE', 'data-confirm' => 'Are you sure that you want to delete this?']) !!}
@stop