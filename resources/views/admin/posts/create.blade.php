@extends('layouts.admin')

@section('content')

    <h1>Create Post</h1>

    <div class="row">
        {!! Form::open(['action' => 'Admin\PostsController@store',
        'method' => 'POST', 'files' => true]) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title :') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category :') !!}
            {!! Form::select('category_id', ['' => 'Choose Options'],
                          null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo', 'Photo :') !!}
            {!! Form::file('photo', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Description :') !!}
            {!! Form::textarea('body', null,
              ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    <div class="row">
        @include('includes.form_errors')
    </div>

@stop