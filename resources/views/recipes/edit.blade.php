@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Edit Recipe: {{ $recipe->title }}</h1>

    <div class="row">
        <div class="col-md-6">

            {!! Form::model($recipe, ['route' => ['recipes.update', $recipe->id], 'method' => 'PATCH']) !!}

            @include('partials.forms.recipes.edit')

            {!! Form::close() !!}

        </div>
        <div class="col-md-offset-4 col-md-2">
            {!! Form::open(array('method' => 'DELETE',
                'route' => array('recipes.destroy', $recipe->id),
                'data-bootbox-message' => 'Are you sure you want to delete ' . $recipe->title . '?')) !!}

            <a href="#" class="bootbox-confirm btn btn-danger">
                Delete Recipe
            </a>

            {!! Form::close() !!}
        </div>
    </div><!-- /.row -->

@endsection
