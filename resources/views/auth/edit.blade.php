@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Edit user</h1>
				</div>
				<div class="panel-body">
					{!! Form::model(Auth::user(), ['route' => 'user_path', 'method' => 'PATCH']) !!}
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							{!! Form::label('name', '* Name:') !!}
							{!! Form::text('name', null, ['class' => 'form-control']) !!}
							{!! $errors->first('name', '<span class="help-block error">:message</span>') !!}
						</div>

						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							{!! Form::label('email', '* Email:') !!}
							{!! Form::text('email', null, ['class' => 'form-control']) !!}
							{!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
						</div>

						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label class="control-label">Password</label>
							<input type="password" class="form-control" name="password">
							{!! $errors->first('password', '<span class="help-block error">:message</span>') !!}
							<span class="help-block stayunchanged">Leave it blank if you don't want to change it.</span>
						</div>

						<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
							<label class="control-label">Confirm Password</label>
							<input type="password" class="form-control" name="password_confirmation">
							{!! $errors->first('password_confirmation', '<span class="help-block error">:message</span>') !!}
						</div>

						<div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
							<label class="control-label">* Current Password</label>
							<input type="password" class="form-control" name="current_password">
							{!! $errors->first('current_password', '<span class="help-block error">:message</span>') !!}
							<span class="help-block stayunchanged">We need you current password to confirm your changes.</span>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
	</div>
</div>
@endsection
