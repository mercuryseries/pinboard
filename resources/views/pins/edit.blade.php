@extends('layouts.app')

@section('content')
	<h1>Edit a pin</h1>

	{!! Form::model($pin, ['route' => ['pins.update', $pin->id], 'method' => 'PATCH']) !!}

		@include('pins/_form', ['submitButtonText' => 'Update'])

	{!! Form::close() !!}

	{!! link_to_route('root_path', 'Cancel') !!}
@stop