@extends('admin.main')

@section('title', 'All Orders')

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
            @foreach($user->clients as $client)
                @foreach($client->orders as $order)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row" style="line-height: 32px;">
                                <div class="col-md-6">
                                    <span>Order #{{$order->id}} (<strong>{{$client->business_name}}</strong>)</span>
                                </div>
                                <div class="col-md-4" style="text-align: right">
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
            @endforeach

        </div>
    </div>

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
                    <a property="item" typeof="WebPage" href="{{ route('admin.user') }}">
                        <span property="name">All Agency</span>
                    </a>
                    <meta property="position" content="2">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="#">
                        <span property="name">{{$user->name}}</span>
                    </a>
                    <meta property="position" content="3">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('admin.order.agency', $user->id) }}">
                        <span property="name">All Orders</span>
                    </a>
                    <meta property="position" content="4">
                </li>
            </ol>
        </div>
    </div>
@endsection
