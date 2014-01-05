@if (Session::has('success'))
    <div class="container">
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{{ Session::get('success') }}}</strong>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="container">
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @if ($errors->has(0))
                <strong>{{{ $errors->first(0) }}}</strong>
            @else
                Please check below for errors.
            @endif
        </div>
    </div>
@endif
