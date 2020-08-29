@extends('layouts.admin')

@section('content')

    <h1>Edit User</h1>

    <div class="row">
        <div class="col-sm-3">
            <img src="{{ $user->photo ? $user->photo->file : asset('images/defaultuser.png') }}"
                 class="img-responsive img-rounded" alt="">
        </div>

        <div class="col-sm-9">
            {!! Form::model($user, ['action' => ['Admin\UsersController@update', $user->id],
                'method' => 'PATCH', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name :') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email :') !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('role_id', 'Role :') !!}
                {!! Form::select('role_id', ['' => 'Choose Options'] + $roles,
                    null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('is_active', 'Status :') !!}
                {!! Form::select('is_active', [1 => 'Active', 0 => 'Not Active'],
                      null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo', 'Photo :') !!}
                {!! Form::file('photo', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password :') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update User', ['class' => 'btn btn-primary col-sm-2']) !!}
            </div>

            {!! Form::close() !!}

            {!! Form::model($user, ['action' => ['Admin\UsersController@destroy', $user->id],
                 'method' => 'DELETE']) !!}
            <div class="form-group">
                {!! Form::submit('Delete User', ['class' => 'btn btn-danger col-sm-2']) !!}
            </div>
            {!! Form::close() !!}

        </div>
    </div>

    <div class="row">
        @include('includes.form_errors')
    </div>

@stop