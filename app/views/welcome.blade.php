@extends('template')

@section('content')

<div class="page-header">
	<h1>Checkins</h1>
</div>

@if (count($checkins) > 0)
	<ul class="checkins">
		@foreach ($checkins as $checkin)
			<li>
				<p>
					<strong>{{{ $checkin->user->first_name }}} {{{ $checkin->user->last_name }}}</strong> checked in at <strong>{{{ $checkin->place->name }}}</strong>! <small>{{{ $checkin->created_at->diffForHumans() }}}</small>
				</p>
			</li>
		@endforeach
	</ul>
@else
	<div class="alert alert-error">
		<p>No checkins available yet. Have you seeded your database?</p>
	</div>
@endif

@stop
