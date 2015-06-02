@extends('layouts.admin')

@section('content')
    <h1 class="page-header">All Users</h1>

    @if( ! count($users))
        <p>There are no users.</p>
    @else
        <table class="table">
            <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{!! link_to("/admin/users/$user->id", $user->username) !!}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="/admin/users/{{ $user->id }}/edit" title="Edit">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                    </td>

                    <td>
                        {!! Form::open(array('method' => 'DELETE',
                            'route' => array('admin.users.destroy', $user->id),
                            'data-bootbox-message' => 'Are you sure you want to delete ' . $user->username . '?')) !!}

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