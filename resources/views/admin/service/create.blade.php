@extends('admin.main')

@section('title', 'Create New Service')

@section('breadcrumbs')
    <div id="breadcrumbs-container">
        <div class="container-small">
            <ol vocab="http://schema.org/" typeof="BreadcrumbList" class="breadcrumbs">
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{route('home')}}">
                        <span property="name">Dashboard</span>
                    </a>
                    <meta property="position" content="1">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('service.index') }}">
                        <span property="name">All Services</span>
                    </a>
                    <meta property="position" content="2">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('service.create') }}">
                        <span property="name">Create New Service</span>
                    </a>
                    <meta property="position" content="3">
                </li>

            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Create New Service
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">

            {!! Form::open(['route' => 'service.store', 'files' => 'true']) !!}

            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '']) }}

            {{ Form::label('image', 'Image:') }}
            {{ Form::file('image') }}

            <div class="row">
                <div class="col-md-4">
                    {{ Form::label('price', 'Price:') }}
                    {{ Form::text('price', null, ['class' => 'form-control', 'required' => '']) }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    {{ Form::label('old_price', 'Old price:') }}
                    {{ Form::text('old_price', null, ['class' => 'form-control']) }}
                </div>
            </div>
            {{ Form::label('short_description', 'Short description:') }}
            {{ Form::textarea('short_description', null, ['class' => 'form-control']) }}

            {{ Form::label('description', 'Description:') }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'text-editor']) }}

            {{ Form::label('active', 'Active:') }}
            {{ Form::checkbox('active', 'checked', ['class' => 'form-control']) }}



            <br />
            {{ Form::submit('Create Service', ['class' => 'btn btn-success btn-lg btn-block']) }}
            <br />
            {!! Form::close() !!}

        </div>
    </div>

@endsection


@section('javascripts')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'#text-editor',
            plugins:'link code'
        });
    </script>
@endsection