@extends('admin.main')

@section('title', 'All Subscriptions')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                All Subscriptions
            </h1>
            <div class="orders-buttons-cont">
                <a class="btn btn-primary" href="{{route('admin.subscriptions.new')}}">New Subscriptions</a>
                <a class="btn btn-primary" href="{{route('admin.subscriptions.active')}}">Active Subscriptions</a>
                <a class="btn btn-primary" href="{{route('admin.subscriptions.completed')}}">Completed Subscriptions</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        @foreach($subscriptions as $subscription)
            @if (isset($current_status))
                @if($current_status->id == $subscription->status->id)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row" style="line-height: 32px;">
                                <div class="col-md-6">
                                    <span>Order #{{$subscription->id}} (<strong>{{$client->business_name}}</strong>)</span>

                                    <div class="form-inline">
                                        <label for="order_status" class="bg-color-blue">Status:</label>
                                        <select name="order_status" class="order_status form-control" data-order-id="{{$subscription->id}}">
                                            @foreach($statuses as $status)
                                                @if($subscription->status->id == $status->id)
                                                    <option selected value="{{$status->id}}">{{$status->name}}</option>
                                                @else
                                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span id="status-saved-{{$subscription->id}}" class="status-saved btn btn-success glyphicon glyphicon-floppy-saved"></span>
                                    </div>

                                </div>

                                <div class="col-md-4" style="text-align: right">
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
                @endif
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row" style="line-height: 32px;">
                            <div class="col-md-6">
                                <span>Order #{{$subscription->id}} (<strong>{{$subscription->client->business_name}}</strong>)</span>

                                <div class="form-inline">
                                    <label for="order_status" class="bg-color-blue">Status:</label>
                                    <select name="order_status" class="order_status form-control" data-order-id="{{$subscription->id}}">
                                        @foreach($statuses as $status)
                                            @if($subscription->status->id == $status->id)
                                                <option selected value="{{$status->id}}">{{$status->name}}</option>
                                            @else
                                                <option value="{{$status->id}}">{{$status->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span id="status-saved-{{$subscription->id}}" class="status-saved btn btn-success glyphicon glyphicon-floppy-saved"></span>
                                </div>

                            </div>

                            <div class="col-md-4" style="text-align: right">
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
            @endif
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
                    <a property="item" typeof="WebPage" href="{{ route('admin.subscriptions.all') }}">
                        <span property="name">All Subscriptions</span>
                    </a>
                    <meta property="position" content="2">
                </li>
                @if (isset($title))
                    <span> › </span>
                    <li property="itemListElement" typeof="ListItem">
                        <a property="item" typeof="WebPage" href="#">
                            <span property="name">{{$title}}</span>
                        </a>
                        <meta property="position" content="3">
                    </li>
                @endif
            </ol>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('.order_status').on('change', function(){
            var status_id = $(this).val();
            var subscription_id = $(this).attr("data-order-id");
            var token = "{{ csrf_token() }}";
            var url = "{{route('admin.subscriptions.change.status')}}";
            $.ajax({
                type: "POST",
                url: url,
                data: {status_id:status_id, subscription_id:subscription_id, _token:token},
                success: function(data) {
                    $('#status-saved-'+subscription_id).show().css({
                        "opacity" : "1",
                        "transition" : "opacity 2s ease-in-out"
                    });
                }
            });
        });
    </script>

@endsection
