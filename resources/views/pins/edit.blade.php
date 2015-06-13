@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>Edit a pin</h1>

			<img src="{{ $pin->image }}" alt="">

			{!! Form::model($pin, ['route' => ['pins.update', $pin->id], 'files' => true, 'method' => 'PATCH']) !!}

				@include('pins/_form', ['submitButtonText' => 'Update'])

			{!! Form::close() !!}

			{!! link_to_route('root_path', 'Cancel') !!}
		</div>
	</div>
@stop