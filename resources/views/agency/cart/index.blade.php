@extends('agency.main')

@section('title', 'Cart')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                <span class="glyphicon glyphicon-shopping-cart"></span> Cart
            </h1>
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
                @foreach($cart as $cart_item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="/upload_images/services/{{ $cart_item->service->image }}" style="width:250px;"></td>
                        <td><h3>{{$cart_item->service->name}}</h3></td>
                        <td>
                            @foreach($cart_item->cartServiceOptionals as $cartServiceOptional)
                                <div class="row" style="position:relative">
                                    {{$cartServiceOptional->serviceOptionalDescription->description}}
                                    <span class="badge">
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
                        </td>
                        <td>
                            {{ Form::open(['route' => ['cart.destroy', $client->id, $cart_item->id], 'method' =>'DELETE']) }}
                            <button class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> </button>
                            {{ Form::close() }}
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

@section('javascript')
    <script>

    </script>
@endsection