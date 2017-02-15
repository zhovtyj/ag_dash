@extends('admin.main')

@section('title', 'Edit '.$service->name)

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