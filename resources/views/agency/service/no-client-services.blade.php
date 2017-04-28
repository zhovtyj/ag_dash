@extends('agency.main')

@section('title', 'All Services')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                <span class="glyphicon glyphicon-th-list"></span> All Services
            </h1>
        </div>
    </div>
    <hr>
    <div class="grid">
        @foreach($services as $service)
            <div class="grid-item">
                <div class="thumbnail service-container">
                    <div class="service-header">
                        <div class="service-header-name">{{$service->name}}</div>
                        <div class="service-header-price">
                            <span class="glyphicon glyphicon-usd"></span>
                            {{$service->price}}
                        </div>
                        @if(($service->old_price) && ($service->old_price != $service->price))
                            <div class="service-header-old-price">
                                <span class="glyphicon glyphicon-usd"></span>
                                {{$service->old_price}}
                            </div>
                        @endif
                    </div>
                    <img src="/upload_images/services/{{$service->image}}" >
                    <div class="caption">
                        @if(isset($service->category))
                            <h4><small>Category:<br/></small>{{$service->category->name}}</h4>
                        @endif
                        <div>{!! $service->short_description !!}</div>
                        <hr>
                        <ul data-service-id="{{$service->id}}" class="additional-services">
                            @foreach($service->serviceoptionals as $serviceoptional)
                                <h4><strong>{{$serviceoptional->name}}</strong></h4>
                                @foreach($serviceoptional->serviceOptionalDescriptions as $description)
                                    <div class="checkbox">
                                        <label class="additional-services-label">
                                            <input type="checkbox" class="serviceOptionalDescription" data-id="{{$description->id}}" name="serviceOptionalDescription{{$description->id}}" id="serviceOptionalDescription{{$description->id}}" value="{{$description->id}}" data-price="{{$description->price}}">
                                            {{$description->description}}
                                            <span class="additional-services-span badge"><span class="glyphicon glyphicon-usd"></span> {{$description->price}}</span>
                                        </label>
                                    </div>

                                @endforeach
                            @endforeach
                        </ul>
                        <hr>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




    <!-- Modal -->
    <div id="service-added" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="bg-success modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Success!</h4>
                </div>
                <div class="modal-body">
                    <p>Service was added to the cart.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
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
                    <a property="item" typeof="WebPage" href="{{ route('agency.service.services') }}">
                        <span property="name">All Services</span>
                    </a>
                    <meta property="position" content="2">
                </li>
            </ol>
        </div>
    </div>
@endsection