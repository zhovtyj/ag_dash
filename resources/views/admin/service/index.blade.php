@extends('admin.main')

@section('title', 'Services')

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

            </ol>
        </div>
    </div>
@endsection

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

    <div class="grid">
        @foreach($services as $service)
            <div class="grid-item">
                <div class="thumbnail service-container">
                    <img src="/upload_images/services/{{$service->image}}" style="width:100%;">
                    <div class="caption">
                        <h3>{{$service->name}}</h3>
                        @if(isset($service->category))
                            <h4><small>Category:<br/></small>{{$service->category->name}}</h4>
                        @endif
                        <div>{!! $service->short_description !!}{{ strlen(strip_tags($service->short_description)) > 250 ? "..." : "" }}</div>
                        <p>
                            Retail Price:{{$service->old_price}}<span class="glyphicon glyphicon-usd"></span>
                            <br>Bulk Price:{{$service->price}}<span class="glyphicon glyphicon-usd"></span>
                        </p>
                        <p>Sort Number: {!! $service->sort_number !!}</p>
                        <hr>
                        <ul data-service-id="{{$service->id}}" class="additional-services">
                            @foreach($service->serviceoptionals as $serviceoptional)
                                <h4><strong>{{$serviceoptional->name}}</strong></h4>
                                @foreach($serviceoptional->serviceOptionalDescriptions as $description)
                                    <div class="checkbox">
                                        <label class="additional-services-label">
                                            <input type="checkbox" name="serviceOptionalDescription{{$description->id}}" id="serviceOptionalDescription{{$description->id}}" value="{{$description->id}}" data-price="{{$description->price}}">
                                            {{$description->description}}
                                            <span class="additional-services-span badge"><span class="glyphicon glyphicon-usd"></span> {{$description->price}}</span>
                                        </label>
                                    </div>

                                @endforeach
                            @endforeach
                        </ul>
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
        @endforeach
    </div>

@endsection

@section('javascript')
    <script src="https://unpkg.com/imagesloaded@4.1/imagesloaded.pkgd.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            var $grid = $('.grid');
            $grid.imagesLoaded( function(){
                $grid.isotope({
                    layoutMode: 'fitRows',
                    //percentPosition: true,
                    itemSelector: '.grid-item'
                });
            });
        })

    </script>
@endsection

@section('stylesheets')
    <style>
        .grid-item{
            width:275px;
            margin-right:20px;
            margin-bottom: 20px;
        }
        .grid{
            width:100%;
        }
    </style>
@endsection