@extends('template')

@section('content')

<div class="page-header">
	<h1>Places</h1>
</div>

<div class="alert alert-info">
	You have permission to list places!
</div>
@if ( ! Sentry::hasAccess('places.delete'))
	<div class="alert alert-warning">
		You don't have permission to delete places.
	</div>
@endif

<table class="table table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Created At</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($places as $place)
			<tr>
				<td>{{{ $place['name'] }}}</td>
				<td>{{{ $place['created_at'] }}}</td>
				<td>
					<a href="{{ URL::to("admin/places/{$place['id']}/edit") }}" class="btn btn-default" @if ( ! Sentry::hasAccess('places.edit')) disabled @endif>Edit</a>
					<a href="{{ URL::to("admin/places/{$place['id']}/delete") }}" class="btn btn-danger btn-xs"  @if ( ! Sentry::hasAccess('places.delete')) disabled @endif>Delete</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

@stop
