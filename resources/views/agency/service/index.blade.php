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
                                                <a href="" class="btn btn-primary btn-block" role="button">
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
                        @if(($i%3)==0)
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        //Add Service to the cart
        var url = "";
        var token = "{{ csrf_token() }}";
        $('.add-to-cart').on('click', function(){
            var  id = $(this).attr("id");
            console.log(id);
            $.ajax({
                type: "POST",
                url: url,
                data: {id:id, _token:token},
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