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
                                    <p>{!! mb_substr(strip_tags($service->short_description), 0, 150) !!}{{ strlen(strip_tags($service->short_description)) > 150 ? "..." : "" }}</p>
                                    <hr>
                                    <ul data-service-id="{{$service->id}}" class="additional-services">
                                        @foreach($service->serviceoptionals as $serviceoptional)
                                            <h4><strong>{{$serviceoptional->name}}</strong></h4>
                                                @foreach($serviceoptional->serviceOptionalDescriptions as $description)
                                                <div class="checkbox">
                                                    <label class="additional-services-label">
                                                        <input type="checkbox" name="serviceOptionalDescription{{$description->id}}" id="serviceOptionalDescription{{$description->id}}" value="{{$description->id}}">
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
                                                <a href="{{ route('agency.service.show', $service->id) }}" class="btn btn-primary btn-block" role="button">
                                                    <span class="glyphicon glyphicon-eye-open"> </span>
                                                    Read more
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-success btn-block add-to-cart" role="button" id="{{$service->id}}">
                                                    <span class="glyphicon glyphicon-shopping-cart"> </span>
                                                    Add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(($loop->iteration % 3) == 0)
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        //Add Service to the cart
        var url = "{{route('agency.addtocart', $client->id)}}";
        var token = "{{ csrf_token() }}";
        $('.add-to-cart').on('click', function(){
            var  id = $(this).attr("id");
            var description_ids = [];
            $('[data-service-id='+id+'] input:checkbox:checked').each(function(){
                description_ids.push($(this).val());
            });
            console.log(id);
            console.log(description_ids);
            $.ajax({
                type: "POST",
                url: url,
                data: {id:id, description_ids:description_ids, _token:token},
                success: function(data) {
                    //Inc Cart count
                    var cartCount = $('#cart-count').text();
                    cartCount = Number(cartCount)+1;
                    $('#cart-count').html(cartCount);
                    $('.cart-empty').hide();
                    $('.link-to-cart').show();
                    $('.append-before').before('' +
                        '<li>' +
                        '<a href="/services/'+data.id+'">' +
                        '<div>' +
                        '<i class="glyphicon glyphicon-check"></i>'+data.name+'' +
                        '<span class="pull-right text-muted small">'+data.price+'$</span>' +
                        '</div>' +
                        '</a>' +
                        '</li>');
                    console.log(data);
                }
            });
        });
    </script>
@endsection