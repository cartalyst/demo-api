@extends('template')

@section('content')

<div class="container">

	<div class="page-header">
		<h1>Login</h1>
	</div>

	{{ Form::open(['class' => 'form-horizontal']) }}

		<div class="form-group {{ $errors->first('email', 'has-error') }}">
			<label for="email" class="control-label col-sm-2">Email</label>
			<div class="col-sm-10">
				{{ Form::text('email', null, ['class' => 'form-control']) }}
				@if ($errors->has('email'))
					<span class="help-block">{{{ $errors->first('email') }}}</span>
				@endif
			</div>
		</div>

		<div class="form-group {{ $errors->first('password', 'has-error') }}">
			<label for="password" class="control-label col-sm-2">Password</label>
			<div class="col-sm-10">
				{{ Form::password('password', ['class' => 'form-control']) }}
				@if ($errors->has('password'))
					<span class="help-block">{{{ $errors->first('password') }}}</span>
				@endif
			</div>
		</div>

		<div class="form-group {{ $errors->first('name', 'has-error') }}">
			<div class="col-sm-10 col-sm-offset-2">
				{{ Form::submit('Login', ['class' => 'btn btn-primary btn-lg']) }}
			</div>
		</div>

	{{ Form::close() }}
</div>

@stop
