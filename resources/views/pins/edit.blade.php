@extends('layouts.app')

@section('content')
	<h1>Edit a pin</h1>

	{!! Form::model($pin, ['route' => ['pins.update', $pin->id], 'method' => 'PATCH']) !!}

		@include('pins/_form', ['submitButtonText' => 'Edit a pin'])

	{!! Form::close() !!}

	<a href="{{ route('root_path') }}">Back</a>
@stop