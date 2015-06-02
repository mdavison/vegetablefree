@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Submit a Recipe</h1>
    <p>Note: All recipes are subject to administrator approval. After your recipe has been approved, it will show up on the site.</p>

    <div class="row">
        <div class="col-md-6">

            <p>Photos (5 max)</p>
            <form action="{{ url('photos/store') }}" class="dropzone" id="my-dropzone">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="photos_token" value="{{ $photos_token }}">
            </form>

            <br>

            {!! Form::open(['route' => 'recipes.store', 'files' => true, 'id' => 'recipe-form']) !!}

                @include('partials.forms.recipes.create')

            {!! Form::close() !!}

        </div>
    </div><!-- /.row -->

@endsection

@include('partials.dropzone')
