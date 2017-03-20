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
    <div class="row">
        <div class="col-md-12">
            @foreach($services as $service)
                @if($loop->iteration == 1 || ($loop->iteration%3) == 0)
                    <div class="row">
                        @endif
                        <div class="col-sm-6 col-md-4">
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
                                    <p>{!! mb_substr(strip_tags($service->short_description), 0, 150) !!}{{ strlen(strip_tags($service->short_description)) > 150 ? "..." : "" }}</p>
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
                                    {{--@if(isset($service->serviceSubscription))--}}
                                        {{--{!! Form::open(['route' => ['paypal.subscribe', $client->id], 'method' => 'post']) !!}--}}
                                        {{--<div>--}}
                                            {{--<input type="hidden" name="service_id" value="{{$service->id}}">--}}
                                            {{--<input type="hidden" id="service_optional_ids" name="service_optional_ids" value="">--}}
                                        {{--</div>--}}
                                        {{--<div style="margin:10px 0;">--}}
                                            {{--<button type="submit" class="btn btn-block btn-success">--}}
                                                {{--<span class="glyphicon glyphicon-usd"></span>--}}
                                                {{--Subscribe with PayPal--}}
                                            {{--</button>--}}
                                            {{--<hr>--}}
                                        {{--</div>--}}
                                        {{--{!! Form::close() !!}--}}
                                    {{--@endif--}}
                                    {{--<div class="bottom-buttons">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-6">--}}
                                                {{--<a href="{{ route('agency.service.show', [$client->id, $service->id]) }}" class="btn btn-primary btn-block" role="button">--}}
                                                    {{--<span class="glyphicon glyphicon-eye-open"> </span>--}}
                                                    {{--Read more--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-6">--}}
                                                {{--<button class="btn btn-success btn-block add-to-cart" role="button" id="{{$service->id}}" data-toggle="modal" data-target="#service-added">--}}
                                                    {{--<span class="glyphicon glyphicon-shopping-cart"> </span>--}}
                                                    {{--Add to cart--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                        @if(($loop->iteration % 3) == 0)
                    </div>
                @endif
            @endforeach
        </div>
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

    <!-- Modal -->
    {{--<div id="choose-client" class="modal fade" role="dialog">--}}
        {{--<div class="modal-dialog">--}}

            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content">--}}

                {{--{!! Form::open(['route' => ['service.change.client'], 'method' => 'post']) !!}--}}
                {{--<input type="hidden" name="current_client_id" value="{{$client->id}}">--}}
                {{--<div class="bg-primary modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                    {{--<h4 class="modal-title">Choose client</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}

                    {{--<div class="form-group">--}}
                        {{--<label for="client_id">Please select a Client:</label>--}}
                        {{--<select name="client_id" class="form-control">--}}
                            {{--@foreach(Auth::user()->clients as $cl)--}}
                                {{--<option value="{{$cl->id}}">{{$cl->business_name}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}

                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                {{--</div>--}}
                {{--{!! Form::close() !!}--}}

            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('javascript')
    {{--<script>--}}
        {{--//Save checked Optional Serviced ids and send to--}}
        {{--$('.serviceOptionalDescription').on('change', function(){--}}
            {{--if(this.checked){--}}
                {{--$('#service_optional_ids').val($('#service_optional_ids').val()+','+$(this).val());--}}
                {{--console.log($('#service_optional_ids').val());--}}
            {{--}--}}
            {{--else{--}}
                {{--var str = $('#service_optional_ids').val().replace($(this).val(), '');--}}
                {{--str = str.replace(/,,/g, ',');--}}
                {{--$('#service_optional_ids').val(str);--}}
                {{--console.log($('#service_optional_ids').val());--}}
            {{--}--}}
        {{--});--}}

        {{--//Close Modal--}}
        {{--$('.add-to-cart').on('click', function(){--}}
            {{--function closeModal() {--}}
                {{--$('#service-added').modal('hide');--}}
            {{--}--}}
            {{--setTimeout(closeModal, 2500);--}}
        {{--});--}}


        {{--//Add Service to the cart--}}
        {{--var url = "{{route('agency.addtocart', $client->id)}}";--}}
        {{--var token = "{{ csrf_token() }}";--}}
        {{--$('.add-to-cart').on('click', function(){--}}
            {{--var id = $(this).attr("id");--}}
            {{--var description_ids = [];--}}
            {{--var total_service_price = 0;--}}
            {{--$('[data-service-id='+id+'] input:checkbox:checked').each(function(){--}}
                {{--description_ids.push($(this).val());--}}
                {{--total_service_price = total_service_price + Number($(this).attr('data-price'));--}}
            {{--});--}}
            {{--console.log(id);--}}
            {{--//console.log(total_service_price);--}}
            {{--console.log(description_ids);--}}
            {{--$.ajax({--}}
                {{--type: "POST",--}}
                {{--url: url,--}}
                {{--data: {id:id, description_ids:description_ids, _token:token},--}}
                {{--success: function(data) {--}}
                    {{--//Inc Cart count--}}
                    {{--var cartCount = $('#cart-count').text();--}}
                    {{--cartCount = Number(cartCount)+1;--}}
                    {{--var service_price=total_service_price+data.service.price;--}}
                    {{--$('#cart-count').html(cartCount);--}}
                    {{--$('.cart-empty').hide();--}}
                    {{--$('.link-to-cart').show();--}}
                    {{--$('.append-before').before('' +--}}
                        {{--'<li>' +--}}
                        {{--'<a href="/services/'+data.service.id+'">' +--}}
                        {{--'<div>' +--}}
                        {{--'<i class="glyphicon glyphicon-check"></i>'+data.service.name+'' +--}}
                        {{--'<span class="pull-right text-muted small">'+service_price+'$</span>' +--}}
                        {{--'</div>' +--}}
                        {{--'</a>' +--}}
                        {{--'</li>');--}}
                    {{--console.log(data);--}}
                {{--}--}}
            {{--});--}}
            {{--$(this).html('<span class="glyphicon glyphicon-shopping-cart"> </span> Added in cart')--}}
        {{--});--}}

        {{--//Show window to chose the client--}}
        {{--$('#go-to-cart').on('click', function(event){--}}
            {{--event.preventDefault();--}}
            {{--$('#choose-client').modal('show');--}}
        {{--});--}}
    {{--</script>--}}
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