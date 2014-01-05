@extends('template')

@section('content')

<div class="page-header">
    <h1>Places</h1>
</div>

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
                    <a href="{{ URL::to("admin/places/{$place['id']}/edit") }}" class="btn btn-default">Edit</a>
                    <a href="{{ URL::to("admin/places/{$place['id']}/delete") }}" class="btn btn-danger btn-xs">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop
