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

            {!! Form::open(['route' => 'service.store', 'data-parsley-validate' =>'', 'files' => 'true']) !!}

            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

            {{ Form::label('image', 'Image:') }}
            {{ Form::file('image') }}

            <div class="form-group">
                {{ Form::label('category_id', 'Category:') }}
                <select class="form-control" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-4">
                    {{ Form::label('price', 'Price:') }}
                    {{ Form::text('price', null, ['class' => 'form-control', 'data-parsley-type' => 'integer', 'required' => '']) }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    {{ Form::label('old_price', 'Old price:') }}
                    {{ Form::text('old_price', null, ['class' => 'form-control', 'data-parsley-type' => 'integer']) }}
                </div>
            </div>
            {{ Form::label('short_description', 'Short description:') }}
            {{ Form::textarea('short_description', null, ['class' => 'form-control']) }}

            {{ Form::label('description', 'Description:') }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'text-editor']) }}

            {{ Form::label('active', 'Active:') }}
            {{ Form::checkbox('active', 'checked', ['class' => 'form-control']) }}

            <div class="row">
                <div class="col-md-4">
                    {{ Form::label('subscription', 'Subscription:') }}
                    {{ Form::checkbox('subscription', 1, null) }}
                </div>
            </div>

            {{--<div class="row subscription-period">--}}
                {{--<div class="col-md-2">--}}
                    {{--{{ Form::label('min_subscription', 'Min subscription:') }}--}}
                    {{--{{ Form::text('min_subscription', null, ['class' => 'form-control']) }}--}}
                {{--</div>--}}
                {{--<div class="col-md-2">--}}
                    {{--{{ Form::label('max_subscription', 'Max subscription:') }}--}}
                    {{--{{ Form::text('max_subscription', null, ['class' => 'form-control']) }}--}}
                {{--</div>--}}
            {{--</div>--}}



            <br />
            {{ Form::submit('Create Service', ['class' => 'btn btn-success btn-lg btn-block']) }}
            <br />
            {!! Form::close() !!}

        </div>
    </div>


@endsection

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@endsection

@section('javascripts')
    <script>
//        $('.subscription-period').hide();
//        $('#subscription').on('change', function(){
//            $('.subscription-period').show();
//        });
    </script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    {!! Html::script('js/parsley.min.js') !!}
    <script>
        tinymce.init({
            selector:'#text-editor',
            plugins:'link code'
        });
    </script>
@endsection