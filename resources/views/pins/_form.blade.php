<!-- Image Form Input -->
<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
	{!! Form::label('image', 'Image:') !!}
	{!! Form::file('image', ['class' => 'form-control']) !!}
	{!! $errors->first('image', '<span class="help-block error">:message</span>') !!}
</div>

<!-- Title Form Input -->
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	{!! Form::label('title', 'Title:') !!}
	{!! Form::text('title', null, ['class' => 'form-control']) !!}
	{!! $errors->first('title', '<span class="help-block error">:message</span>') !!}
</div>

<!-- Description Form Input -->
<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
	{!! Form::label('description', 'Description:') !!}
	{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
	{!! $errors->first('description', '<span class="help-block error">:message</span>') !!}
</div>

<!--  Form Input -->
<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</div>