@extends('layouts.admin')

@section('content')
    <h1 class="page-header">User Account</h1>

    <div class="panel panel-info">
        <div class="panel-heading">
            Personal Information
            <a href="/admin/users/{{ $user->id }}/edit" title="Edit" class="pull-right">
                <span class="glyphicon glyphicon-edit"></span>
            </a>
        </div>
        <ul class="list-group">
            <li class="list-group-item">{{ $user->username }}</li>
            <li class="list-group-item">{{ $user->email }}</li>
        </ul>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">User Recipes</div>
        <ul class="list-group">
            @foreach($user->recipes as $recipe)
                <li class="list-group-item">{!! link_to("/recipes/{$recipe->id}", $recipe->title) !!}
                    @if($recipe->is_approved)
                        <span class="pull-right"><span class="glyphicon glyphicon-ok-circle" title="Approved" data-toggle="tooltip"></span></span>
                    @else
                        <span class="pull-right">Pending Approval</span>
                    @endif

                </li>
            @endforeach
        </ul>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Favorited Recipes</div>
        <ul class="list-group">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
    </div>

@stop