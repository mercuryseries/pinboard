@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1>Reset Password</h1>
					</div>
					<div class="panel-body">
						<form role="form" method="POST" action="{{ url('/password/email') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
								<label class="control-label">E-Mail Address</label>
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
								{!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary">
									Send Password Reset Link
								</button>
							</div>
						</form>
					</div>
				</div>
		</div>
	</div>
</div>
@endsection
