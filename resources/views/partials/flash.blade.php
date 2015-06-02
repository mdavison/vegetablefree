@if(Session::has('message'))
    <div class="alert alert-success alert-dismissible fade in flash" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! Session::get('message') !!}
    </div>
@endif

@if(Session::has('error') || count($errors))
    @if(Session::has('error'))
        <div class="alert alert-danger flash" role="alert">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            {{ Session::get('error') }}
        </div>
    @else
        <ul class="alert alert-danger list-unstyled flash">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endif