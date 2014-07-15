@extends('template')

@section('content')

<div class="page-header">
	<h1>Edit Place {{{ $place['name'] }}}</h1>
</div>

@if ( ! Sentinel::hasAccess('places.delete'))
	<div class="alert alert-warning">
		You don't have permission to delete places. Don't believe me? Bypass the button and go straight to <a href="{{ URL::to("admin/places/{$place['id']}/delete") }}">{{ URL::to("admin/places/{$place['id']}/delete") }}</a>
	</div>
@endif

{{ Form::open(['class' => 'form-horizontal']) }}
	<div class="form-group {{ $errors->first('name', 'has-error') }}">
		<label for="name" class="control-label col-sm-2">Name</label>
		<div class="col-sm-10">
			{{ Form::text('name', Input::old('name', $place['name']), ['class' => 'form-control', 'id' => 'name']) }}
			@if ($errors->has('name'))
				<span class="help-block">{{{ $errors->first('name') }}}</span>
			@endif
		</div>
	</div>
	<div class="form-group {{ $errors->first('address', 'has-error') }}">
		<label for="address" class="control-label col-sm-2">Address</label>
		<div class="col-sm-10">
			{{ Form::textarea('address', Input::old('address', $place['address']), ['class' => 'form-control', 'id' => 'address']) }}
			@if ($errors->has('address'))
				<span class="help-block">{{{ $errors->first('address') }}}</span>
			@endif
		</div>
	</div>
	<div class="form-group {{ $errors->first('address', 'has-error') }}">
		<div class="col-sm-10 col-sm-push-2">
			{{ Form::submit('Save', ['class' => 'btn btn-primary btn-lg', ( ! Sentinel::hasAccess('places.update') ? 'disabled' : '')]) }}
			{{ Form::reset('Reset', ['class' => 'btn btn-default', ( ! Sentinel::hasAccess('places.update') ? 'disabled' : '')]) }}
			<a href="{{ URL::to("admin/places/{$place['id']}/delete") }}" class="btn btn-danger" @if ( ! Sentinel::hasAccess('places.delete')) disabled @endif>Delete</a>
		</div>
	</div>
{{ Form::close () }}
@stop
