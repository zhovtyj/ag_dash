@extends('agency.main')

@section('title', 'Cart')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                <span class="glyphicon glyphicon-shopping-cart"></span> Cart
            </h1>
        </div>
        <div class="col-md-3">
            <button class="btn btn-block btn-danger" style="margin-top:20px;">
                Balance:
                <span class="glyphicon glyphicon-usd"></span>
                <strong>
                    @if(isset(Auth::user()->deposit->balance ))
                        {{Auth::user()->deposit->balance }}
                    @else
                        0.00
                    @endif
                </strong>
            </button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Image</td>
                    <td>Service</td>
                    <td>Additional Services</td>
                    <td>Price</td>
                    <td> </td>
                </tr>
                </thead>
                <tbody>
                <?php $total_price = 0;?>
                @foreach($cart as $cart_item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="/upload_images/services/{{ $cart_item->service->image }}" style="width:250px;"></td>
                        <td><h3>{{$cart_item->service->name}}</h3></td>
                        <td>
                            @foreach($cart_item->cartServiceOptionals as $cartServiceOptional)
                                <div class="row" style="position:relative">
                                    {{$cartServiceOptional->serviceOptionalDescription->description}}
                                    <span class="badge" style="float:right;">
                                        <span class="glyphicon glyphicon-usd"></span>
                                        {{$cartServiceOptional->serviceOptionalDescription->price}}
                                    </span>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <span class="glyphicon glyphicon-usd"></span>
                            <?php $cart_item_total_price = 0;?>
                            @if(isset($cart_item->cartServiceOptionals))
                                @foreach($cart_item->cartServiceOptionals as $cartServiceOptional)
                                    <?php $cart_item_total_price += $cartServiceOptional->serviceOptionalDescription->price; ?>
                                @endforeach
                            @endif
                            <strong>{{$cart_item_total_price+$cart_item->service->price}}</strong>
                            <?php $total_price += $cart_item_total_price+$cart_item->service->price ?>
                        </td>
                        <td>
                            {{ Form::open(['route' => ['cart.destroy', $client->id, $cart_item->id], 'method' =>'DELETE']) }}
                            <button class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> </button>
                            {{ Form::close() }}
                        </td>
                    </tr>

                @endforeach
                <tr>
                    <td colspan="4"></td>
                    <td>
                        Total:<br>
                        <span class="glyphicon glyphicon-usd"></span>
                        <strong id="cart-total-price">{{$total_price}}</strong>
                    </td>
                    <td></td>
                </tr>
                <tr id="tr-discount" style="visibility: hidden;">
                    <td colspan="4"></td>
                    <td>
                        Total With Discount:<br>
                        <span class="glyphicon glyphicon-usd"></span>
                        <strong id="cart-total-price-discount"></strong>
                    </td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-inline">
                <label>I have a Coupon:</label>
                <input type="text" name="coupon" id="coupon" class="form-control">
                <button id="refresh-price" class="btn btn-primary">
                    <span class="glyphicon glyphicon-refresh"></span>
                    Refresh Total Price
                </button>
            </div>
        </div>
        <div class="col-md-3">

            @if(isset(Auth::user()->deposit->balance ) && Auth::user()->deposit->balance >= $total_price && $total_price !=0 )
                {!! Form::open(['route' => ['cart.deposit', $client->id], 'method' =>'POST']) !!}

                {!! Form::hidden('pay', $total_price) !!}
                {!! Form::hidden('deposit_coupon', null, ['id'=>'deposit_coupon']) !!}
                <button type="submit" id="pay-fron-deposit" class="btn btn-success btn-block">Pay from Balance</button>

                {!! Form::close() !!}
            @else
                <button id="pay-fron-deposit" class="btn btn-success btn-block">Pay from Balance</button>
            @endif

        </div>
        <div class="col-md-3">
            {!! Form::open(['route' => ['getCheckout', $client->id], 'method' =>'POST']) !!}

                {!! Form::hidden('pay', $total_price) !!}
                {!! Form::hidden('paypal_coupon', null, ['id'=>'paypal_coupon']) !!}
                <button type="submit" class="btn btn-success btn-block">Pay with PayPal</button>

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('#refresh-price').on('click', function(){
            var token = "{{ csrf_token() }}";
            var url = "{{route('cart.check-coupon')}}";
            var coupon = $('#coupon').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {coupon:coupon, _token:token},
                success: function(data) {
                    if(data.success){
                        var total_price = $('#cart-total-price').text();
                        var total_price_discount = total_price - (total_price*data.discount/100);
                        total_price_discount = Math.round(total_price_discount);
                        $('#tr-discount').css('visibility', 'visible');
                        $('#cart-total-price-discount').text(total_price_discount);
                        $('#deposit_coupon, #paypal_coupon').val(coupon);
                    }
                    if(data.error){
                        console.log(data.error);
                    }
                }
            });

        });
    </script>
@endsection