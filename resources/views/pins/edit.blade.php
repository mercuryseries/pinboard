@extends('layouts.app')

@section('content')
	<div id="edit_page" class="col-md-8 col-md-offset-2">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Edit a pin</h1>
				</div>
				<div class="panel-body">
					<div class="current_image">
						<strong class="center">Current Image</strong>
						<img src="{{ $pin->mediumImage() }}" alt="">
					</div>
					{!! Form::model($pin, ['route' => ['pins.update', $pin->id], 'files' => true, 'method' => 'PATCH']) !!}

						@include('pins/_form', ['submitButtonText' => 'Update'])

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop