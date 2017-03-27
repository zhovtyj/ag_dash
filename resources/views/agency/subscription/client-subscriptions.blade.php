@extends('agency.main')

@section('title', 'All Subscriptions')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                All Subscriptions
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        @foreach($subscriptions as $subscription)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row" style="line-height: 32px;">
                        <div class="col-md-6">
                            <span>Order #{{$subscription->id}} (<strong>{{$client->business_name}}</strong>)</span>
                        </div>
                        <div class="col-md-4" style="text-align: right">
                            <span class="order-status">
                                <span class="glyphicon glyphicon-info-sign"></span>
                                Status: {{$subscription->status->name}}
                            </span>
                            <span style="text-align:right">
                                <span class="glyphicon glyphicon-time"></span>
                                {{$subscription->created_at}}
                            </span>
                        </div>
                        <div class="col-md-2">
                            <a target="_blank" href="{{route('subscription.pdf', $subscription->id)}}" class="btn btn-sm btn-block btn-primary"><span class="glyphicon glyphicon-print"></span> Generate PDF</a>
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
                        @foreach($subscription->subscriptionServices as $subscriptionService)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="/upload_images/services/{{ $subscriptionService->service->image }}" style="width:250px;"></td>
                                <td><strong>{{ $subscriptionService->service->name }}</strong></td>
                                <td>${{ $subscriptionService->price }}</td>
                                <td>
                                    <?php $order_item_total_price = 0;?>
                                    @if(isset($subscriptionService->subscriptionServiceOptionals))
                                        @foreach($subscriptionService->subscriptionServiceOptionals as $subscriptionServiceOptional)
                                            <?php $order_item_total_price += $subscriptionServiceOptional->price; ?>
                                            <div>
                                                {{$subscriptionServiceOptional->serviceOptionalDescription->description}}
                                                <span> - ${{$subscriptionServiceOptional->price}}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </td>
                                <td style="text-align: right;"><strong>${{$order_item_total_price+$subscriptionService->price}}</strong></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">
                                <div style="text-align: right;">
                                    <i>Total: </i>
                                    <span class="glyphicon glyphicon-usd"></span>
                                    <strong>{{$subscription->first_price}}</strong>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div style="text-align: right;">
                                    <i>Monthly Price: </i>
                                    <span class="glyphicon glyphicon-usd"></span>
                                    <strong>{{$subscription->monthly_price}}</strong>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
                    <a property="item" typeof="WebPage" href="{{ route('client.index') }}">
                        <span property="name">All Clients</span>
                    </a>
                    <meta property="position" content="2">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('client.show', $client->id) }}">
                        <span property="name">{{$client->business_name}}</span>
                    </a>
                    <meta property="position" content="3">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('subscription.client', $client->id) }}">
                        <span property="name">All Subscriptions</span>
                    </a>
                    <meta property="position" content="4">
                </li>
            </ol>
        </div>
    </div>
@endsection