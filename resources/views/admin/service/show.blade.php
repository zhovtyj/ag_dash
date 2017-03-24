@extends('admin.main')

@section('title', $service->name)

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                {{ $service->name }}
            </h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Image:</h2>
                    <p><img src="/upload_images/services/{{ $service->image }}" style="width:100%;"></p>
                    @if(isset($service->category))
                        <h3><small>Category:<br/></small>{{$service->category->name}}</h3>
                    @endif
                    <hr>
                    <h2>Bulk Price:</h2>
                    <p>{{ $service->price }}</p>
                    <h2>Retail Price:</h2>
                    <p>{{ $service->old_price }}</p>
                    <h2>Short description:</h2>
                    <div>{!! $service->short_description !!}</div>
                    <h2>Description:</h2>
                    <div>{!! $service->description !!}</div>
                    @foreach($service->serviceoptionals as $serviceoptional)
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <strong>{{$serviceoptional->name}} ({{$serviceoptional->service->name}})</strong>
                                @if($serviceoptional->subscription == 1)
                                    <small style="float: right">
                                        Subscription
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </small>
                                @endif
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        @foreach($serviceoptional->serviceOptionalDescriptions as $description)
                                            <li class="list-group-item">
                                                <span class="badge"><span class="glyphicon glyphicon-usd"></span> {{$description->price}}</span>
                                                {{$description->description}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a class="btn btn-block btn-primary" href="{{route('service-optional.edit', $serviceoptional->id)}}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::open(['route' => ['service-optional.destroy', $serviceoptional->id], 'method' =>'DELETE']) }}
                                        <button type="submit" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"> </span> Delete</button>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                            <a href="{{ route('service.edit', $service->id) }}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-edit"></span> Edit</a>
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

            </ol>
        </div>
    </div>
@endsection