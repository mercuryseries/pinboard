@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1>Create a new pin</h1>
					</div>
					<div class="panel-body">
						{!! Form::open(['route' => 'pins.store', 'files' => true]) !!}

							@include('pins/_form', ['submitButtonText' => 'Create a pin'])

						{!! Form::close() !!}
					</div>
				</div>
		</div>
	</div>
@stop