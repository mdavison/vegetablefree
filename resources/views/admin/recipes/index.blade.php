@extends('layouts.admin')

@section('content')
    <h1 class="page-header">All Recipes</h1>

    @if( ! count($recipes))
        <p>There are no recipes yet.</p>
    @else
        <table class="table">
            <thead>
            <th>Approved</th>
            <th>Title</th>
            <th>Uploaded</th>
            <th>Uploaded By</th>
            <th>Edit</th>
            <th>Delete</th>
            </thead>
            <tbody>
            @foreach ($recipes as $recipe)
                <tr>
                    <td>
                        {!! Form::open(['class' => 'approve-recipe', 'id' => $recipe->id]) !!}
                            @if ($recipe->is_approved)
                                <a href="#" title="Unapprove"><span class="glyphicon glyphicon-ok"></span></a>
                            @else
                                <a href="#" title="Approve"><span class="glyphicon glyphicon-unchecked"></span></a>
                            @endif
                        {!! Form::close() !!}

                    </td>
                    <td>{!! link_to("/admin/recipes/$recipe->id", $recipe->title) !!}</td>
                    <td>{{ $recipe->created_at->diffForHumans() }}</td>
                    <td>{{ $recipe->user->username }}</td>
                    <td><a href="/admin/recipes/{{ $recipe->id }}/edit" title="Edit">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                    </td>

                    <td>
                        {!! Form::open(array('method' => 'DELETE',
                            'route' => array('admin.recipes.destroy', $recipe->id),
                            'data-bootbox-message' => 'Are you sure you want to delete ' . $recipe->title . '?')) !!}

                        <a href="#" class="bootbox-confirm">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@stop