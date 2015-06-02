@extends('layouts.app')

@section('content')
    <h1 class="page-header">All Recipes</h1>

    @if( ! count($recipes))
        <p>There are no recipes yet.</p>
    @else
        @include('partials.recipe-grid')
    @endif
@stop