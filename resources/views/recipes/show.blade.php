@extends('layouts.admin')

@section('content')
    @if( ! $recipe->is_approved)
        <div class="alert alert-warning" role="alert">This recipe hasn't been approved yet.</div>
    @endif

    @include('partials.show-recipe')

@stop