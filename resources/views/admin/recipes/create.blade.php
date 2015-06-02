@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Add a Recipe</h1>

    <div class="row">
        <div class="col-md-6">

            <p>Photos (5 max)</p>
            <form action="{{ url('photos/store') }}" class="dropzone" id="my-dropzone">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="photos_token" value="{{ $photos_token }}">
            </form>

            <br>

            {!! Form::open(['route' => 'admin.recipes.store', 'files' => true]) !!}

                @include('partials.forms.recipes.create')

            {!! Form::close() !!}

        </div>
    </div><!-- /.row -->

@endsection

@include('partials.dropzone')