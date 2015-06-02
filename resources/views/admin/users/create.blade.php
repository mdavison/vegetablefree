@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Add a User</h1>

    <div class="row">
        <div class="col-md-6">

            {!! Form::open(['route' => 'admin.users.store']) !!}

            <div class="form-group">
                {!! Form::label('username', 'Name: ') !!}
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
                {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirm Password: ') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
            </div>

            {!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-default']) !!}

            {!! Form::close() !!}

        </div>
    </div><!-- /.row -->

@endsection
