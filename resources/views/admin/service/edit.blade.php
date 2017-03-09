@extends('admin.main')

@section('title', 'Edit '.$service->name)

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
                    <a property="item" typeof="WebPage" href="{{ route('service.show', $service->id) }}">
                        <span property="name">{{ $service->name }}</span>
                    </a>
                    <meta property="position" content="3">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('service.edit', $service->id) }}">
                        <span property="name">Edit</span>
                    </a>
                    <meta property="position" content="4">
                </li>

            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                Edit {{ $service->name }}
            </h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">

                {!! Form::model($service, ['route' => ['service.update', $service->id], 'method' => 'PUT', 'files' => 'true']) !!}

                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', null, ['class' => 'form-control', 'required' => '']) }}

                @if($service->image)
                    <div class="row">
                        <div class="col-md-6">
                            <img src="/upload_images/services/{{$service->image}}" style="max-width:100%">
                        </div>
                    </div>
                @endif
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
                @if($service->active == 1)
                    {{ Form::checkbox('active', 'checked', true) }}
                @else
                    {{ Form::checkbox('active', 'checked') }}
                @endif

                <div class="row">
                    <div class="col-md-4">
                        {{ Form::label('subscription', 'Subscription:') }}
                        {{ Form::checkbox('subscription', 1, null) }}
                    </div>
                </div>

                <div class="row subscription-period">
                    <div class="col-md-2">
                        {{ Form::label('min_subscription', 'Min subscription:') }}
                        {{ Form::text('min_subscription', isset($service->serviceSubscription->min_subscription)?$service->serviceSubscription->min_subscription:'', ['class' => 'form-control']) }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::label('max_subscription', 'Max subscription:') }}
                        {{ Form::text('max_subscription', isset($service->serviceSubscription->max_subscription)?$service->serviceSubscription->max_subscription:'', ['class' => 'form-control']) }}
                    </div>
                </div>


                <br />
                {{ Form::submit('Save changes', ['class' => 'btn btn-success btn-lg btn-block']) }}
                <br />
                {!! Form::close() !!}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-th-large"> </span> Service Info
                </div>
                <div class="panel-body">
                    <h5><span class="glyphicon glyphicon-pencil"> </span> <strong>Created at:</strong></h5>
                    <div>{!! $service->created_at !!}</div>
                    <hr>
                    <h5><span class="glyphicon glyphicon-edit"> </span> <strong>Updated at:</strong></h5>
                    <div>{!! $service->updated_at !!}</div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('service.show', $service->id) }}" class="btn btn-default btn-block"><span class="glyphicon glyphicon-edit"></span> Discard </a>
                        </div>
                        <div class="col-md-6">
                            {{ Form::open(['route' => ['service.destroy', $service->id], 'method' =>'DELETE']) }}

                            <button type="submit" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"> </span> Delete</button>

                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-12">
                            <a class="btn btn-success btn-block" href="{{route('service-optional.create')}}">
                                <span class="glyphicon glyphicon-plus"></span>
                                Add New Additional Service
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-md-offset">
                            <a href="{{ route('service.index') }}" class="btn btn-default btn-block"><span class="glyphicon glyphicon-arrow-left"></span> Back to all services</a>
                        </div>
                    </div>
                </div>
            </div>
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