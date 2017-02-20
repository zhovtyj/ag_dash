@extends('agency.main')

@section('title', $client->business_name.' Orders')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                {{$client->business_name}} Orders
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @foreach($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <span>Order #{{$order->id}}</span>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                <span style="text-align:right">{{$order->created_at}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>Image</td>
                                <td>Service</td>
                                <td>Additional Services</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderServices as $orderService)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="/upload_images/services/{{ $orderService->service->image }}" style="width:250px;"></td>
                                    <td><strong>{{ $orderService->service->name }}</strong></td>
                                    <td>
                                        @if(isset($orderService->orderServiceOptionals))
                                            @foreach($orderService->orderServiceOptionals as $orderServiceOptional)
                                                <div>{{$orderServiceOptional->serviceOptionalDescription->description}}</div>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">
                                    <div style="text-align: right;">
                                        <i>Total: </i>
                                        <span class="glyphicon glyphicon-usd"></span>
                                        <strong>{{$order->price}}</strong></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

            {!! $orders->links() !!}

        </div>
    </div>

@endsection
