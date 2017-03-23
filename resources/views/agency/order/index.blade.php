@extends('agency.main')

@section('title', 'All Orders')

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
                    <a property="item" typeof="WebPage" href="{{ route('order.index') }}">
                        <span property="name">All Orders</span>
                    </a>
                    <meta property="position" content="2">
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                All Orders
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @foreach($clients as $client)
                @foreach($client->orders as $order)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row" style="line-height: 32px;">
                                <div class="col-md-6">
                                    <span>Order #{{$order->id}} (<strong>{{$client->business_name}}</strong>)</span>
                                </div>
                                <div class="col-md-4" style="text-align: right">
                                    <span class="order-status">
                                        <span class="glyphicon glyphicon-info-sign"></span>
                                        Status: {{$order->status->name}}
                                    </span>
                                    <span style="text-align:right">
                                        <span class="glyphicon glyphicon-time"></span>
                                        {{$order->created_at}}
                                    </span>
                                </div>
                                <div class="col-md-2">
                                    <a target="_blank" href="{{route('order.pdf', $order->id)}}" class="btn btn-sm btn-block btn-primary"><span class="glyphicon glyphicon-print"></span> Generate PDF</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Service</th>
                                    <th>Service Price</th>
                                    <th>Additional Services</th>
                                    <th style="text-align: right;">Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderServices as $orderService)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="/upload_images/services/{{ $orderService->service->image }}" style="width:250px;"></td>
                                        <td><strong>{{ $orderService->service->name }}</strong></td>
                                        <td>${{ $orderService->price }}</td>
                                        <td>
                                            <?php $order_item_total_price = 0;?>
                                            @if(isset($orderService->orderServiceOptionals))
                                                @foreach($orderService->orderServiceOptionals as $orderServiceOptional)
                                                    <?php $order_item_total_price += $orderServiceOptional->price; ?>
                                                    <div>
                                                        {{$orderServiceOptional->serviceOptionalDescription->description}}
                                                        <span> - ${{$orderServiceOptional->price}}</span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td style="text-align: right;"><strong>${{$order_item_total_price+$orderService->price}}</strong></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">
                                        <div style="text-align: right;">
                                            <i>Total: </i>
                                            <span class="glyphicon glyphicon-usd"></span>
                                            <strong>{{$order->price}}</strong>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endforeach

        </div>
    </div>

@endsection
