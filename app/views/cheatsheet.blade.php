@extends('template')

@section('content')

@foreach ($users as $user)
	<div class="panel panel-default">
		<div class="panel-heading">
			{{{ $user->first_name }}} {{{ $user->last_name }}}
		</div>
		<div class="panel-body">
			<table class="table">
				<tr>
					<th class="col-xs-2">Email</th>
					<td class="col-xs-10"><pre>{{{ $user->email }}}</pre></td>
				</tr>
				<tr>
					<th>Password</th>
					<td><pre>password</pre></td>
				</tr>
				<tr>
					<th>Group(s)</th>
					<td>
						{{{ implode(', ', $user->groups->lists('name')) }}}
					</td>
				</tr>
				<tr>
					<th>Permissions</th>
					<td>
						<ul>
							@if ($user->hasAccess('checkins.list'))
								<li>
									List checkins over at <a href="{{ URL::to('/') }}" target="_blank">{{ URL::to('/') }}</a>
								</li>
							@endif
							@if ($user->hasAccess('places.list'))
								<li>
									List places over at <a href="{{ URL::to('admin/places') }}" target="_blank">{{ URL::to('admin/places') }}</a>
								</li>
							@endif
							@if ($user->hasAccess('places.edit'))
								<li>
									View places over at <a href="{{ URL::to("admin/places/{$places[0]['id']}/edit") }}" target="_blank">{{ URL::to("admin/places/{$places[0]['id']}/edit") }}</a>
								</li>
							@endif
							@if ($user->hasAccess('places.update'))
								<li>
									Modify places over at <a href="{{ URL::to("admin/places/{$places[0]['id']}/edit") }}" target="_blank">{{ URL::to("admin/places/{$places[0]['id']}/edit") }}</a>
								</li>
							@endif
							@if ($user->hasAccess('places.delete'))
								<li>
									Delete places over at <a href="{{ URL::to("admin/places/{$places[0]['id']}/delete") }}" target="_blank">{{ URL::to("admin/places/{$places[0]['id']}/delete") }}</a>
								</li>
							@endif
						</ul>
					</td>
				</tr>
			</table>
		</div>
	</div>
@endforeach

@stop
