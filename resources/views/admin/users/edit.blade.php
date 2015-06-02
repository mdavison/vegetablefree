@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Edit User</h1>

    <div class="row">
        <div class="col-md-8">
            {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PATCH']) !!}

            <div class="form-group">
                {!! Form::label('username', 'Username: ') !!}
                {!! Form::text('username', null, ['class' => 'form-control', 'autofocus', 'required' => 'required']) !!}
                {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email: ') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password: ') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirm Password: ') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
            </div>

            {!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-default']) !!}

            {!! Form::close() !!}
        </div>
        <div class="col-md-4">
            {!! Form::open(array('method' => 'DELETE',
                'route' => array('admin.users.destroy', $user->id),
                'data-bootbox-message' => 'Are you sure you want to completely delete this account?',
                'class' => 'pull-right')) !!}

            {!! Form::button('Delete Account', ['type' => 'submit', 'class' => 'btn btn-danger bootbox-confirm']) !!}

            {!! Form::close() !!}
        </div>
    </div>




@stop