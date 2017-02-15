@extends('admin.main')

@section('title', 'Services')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                <span class="glyphicon glyphicon-th-list"></span> All Services
            </h1>
        </div>
        <div class="col-md-3">
            <a href="{{ route('service.create')}}" class="btn btn-lg btn-block btn-primary" style="margin-top:20px;"><span class="glyphicon glyphicon-pencil"> </span> Create new</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <?php $i=0?>
            @foreach($services as $service)
                <?php $i++?>
                @if($i==1 || ($i%3)==0)
                    <div class="row">
                        @endif
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail service-container">
                                <img src="/upload_images/services/{{$service->image}}" >
                                <div class="caption">
                                    <h3>{{$service->name}}</h3>
                                    <p>{!! mb_substr(strip_tags($service->short_description), 0, 150) !!}{{ strlen(strip_tags($service->short_description)) > 150 ? "..." : "" }}</p>
                                    <p>
                                        Old price:{{$service->old_price}}<span class="glyphicon glyphicon-usd"></span>
                                        <br>Price:{{$service->price}}<span class="glyphicon glyphicon-usd"></span>
                                    </p>
                                    <div class="bottom-buttons">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ route('service.show', $service->id) }}" class="btn btn-primary btn-block" role="button">
                                                    <span class="glyphicon glyphicon-eye-open"> </span>
                                                    Show
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ route('service.edit', $service->id) }}" class="btn btn-success btn-block" role="button">
                                                    <span class="glyphicon glyphicon-edit"> </span>
                                                    Edit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(($i%3)==0)
                    </div>
                @endif
            @endforeach
        </div>
    </div>

@endsection