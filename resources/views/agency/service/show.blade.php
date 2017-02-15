@extends('main')

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
                    <p><img src="/upload_images/services/{{ $service->image }}" style="width:100%;"></p>
                    <h2>Price:</h2>
                    <p>{{ $service->price }}</p>
                    <h2>Old price:</h2>
                    <p>{{ $service->old_price }}</p>
                    <h2>Short description:</h2>
                    <p>{{ $service->short_description }}</p>
                    <h2>Description:</h2>
                    <p>{!! $service->description !!}</p>
                </div>
            </div>
        </div>
    </div>

@endsection