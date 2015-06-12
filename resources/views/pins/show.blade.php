@extends('layouts.app')

@section('content')
	<h1>{{ $pin->title }}</h1>
	<p>{{ $pin->description }}</p>

	<a href="{{ route('root_path') }}">Back</a>
@stop