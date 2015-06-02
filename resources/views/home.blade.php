@extends('layouts.home')

@section('content')
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Vegetable-Free Recipes</h1>
            <p>
                If you don't like vegetables, finding good recipes can be hard! This site aims to make it easier to find
                and share vegetable-free recipes.
            </p>
            <p><a class="btn btn-primary btn-lg" href="/recipes" role="button">Explore &raquo;</a></p>
        </div>
    </div>

    <div class="container"><h1 class="page-header">Latest Recipes</h1></div>

    @include('partials.recipe-grid')

@stop
