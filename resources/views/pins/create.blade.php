@extends('layouts.app')

@section('content')
	<h1>Create a new pin</h1>

	{!! Form::open(['route' => 'pins.store']) !!}

		@include('pins/_form', ['submitButtonText' => 'Create a pin'])

	{!! Form::close() !!}

	{!! link_to_route('root_path', 'Cancel') !!}
@stop