@extends('layouts.admin')

@section('content')
    <h1 class="page-header">My Account</h1>

    <div class="panel panel-info">
        <div class="panel-heading">
            Personal Information
            <a href="/users/{{ $user->id }}/edit" title="Edit" class="pull-right">
                <span class="glyphicon glyphicon-edit"></span>
            </a>
        </div>
        <ul class="list-group">
            <li class="list-group-item">{{ $user->username }}</li>
            <li class="list-group-item">{{ $user->email }}</li>
        </ul>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">My Recipes</div>
        <ul class="list-group">
            @foreach($user->recipes as $recipe)
                <li class="list-group-item">{!! link_to("/recipes/{$recipe->id}", $recipe->title) !!}
                    @if($recipe->is_approved)
                        <span class="pull-right"><span class="glyphicon glyphicon-ok-circle" title="Approved" data-toggle="tooltip"></span></span>
                    @else
                        <span class="pull-right"><span class="glyphicon glyphicon-unchecked" title="Pending Approval" data-toggle="tooltip"></span></span>
                    @endif

                </li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        @foreach($user->recipes as $recipe)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>
                            {{ $recipe->title }}
                            @if($recipe->is_approved)
                                <span class="pull-right"><span class="glyphicon glyphicon-ok-circle" title="Approved" data-toggle="tooltip"></span></span>
                            @else
                                <span class="pull-right"><span class="glyphicon glyphicon-unchecked" title="Pending Approval" data-toggle="tooltip"></span></span>
                            @endif
                        </h3>

                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@stop

@section('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop