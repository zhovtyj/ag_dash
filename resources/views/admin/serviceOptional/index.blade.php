@extends('admin.main')

@section('title', 'All Optional Services')


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
                    <a property="item" typeof="WebPage" href="{{ route('service-optional.index') }}">
                        <span property="name">All Optional Services</span>
                    </a>
                    <meta property="position" content="2">
                </li>

            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                <span class="glyphicon glyphicon-th-list"></span> All Optional Services
            </h1>
        </div>
        <div class="col-md-3">
            <a href="{{ route('service-optional.create')}}" class="btn btn-lg btn-block btn-primary" style="margin-top:20px;"><span class="glyphicon glyphicon-pencil"> </span> Create new</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-8">
            @foreach($serviceoptionals as $serviceoptional)
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

@endsection