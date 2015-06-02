@extends('layouts.admin')

@section('content')
    <h1 class="page-header">
        Edit Recipe: {{ $recipe->title }}
        @if ($recipe->is_approved)
            <span class="pull-right glyphicon glyphicon-ok-circle text-success" title="Recipe is approved"></span>
        @else
            <span class="pull-right glyphicon glyphicon-remove-circle text-danger" title="Recipe is not approved"></span>
        @endif
    </h1>

    <div class="row">
        <div class="col-md-6">

            {!! Form::model($recipe, ['route' => ['admin.recipes.update', $recipe->id], 'method' => 'PATCH']) !!}

            @include('partials.forms.recipes.edit')

            {!! Form::close() !!}

        </div>
        <div class="col-md-offset-4 col-md-2">
            {!! Form::open(array('method' => 'DELETE',
                'route' => array('admin.recipes.destroy', $recipe->id),
                'data-bootbox-message' => 'Are you sure you want to delete ' . $recipe->title . '?')) !!}

            <a href="#" class="bootbox-confirm btn btn-danger">
                Delete Recipe
            </a>

            {!! Form::close() !!}
        </div>

    </div><!-- /.row -->

@endsection
