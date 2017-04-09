@extends('admin.main')

@section('title', 'All Orders')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                All Orders
            </h1>
            <div class="orders-buttons-cont">
                <a class="btn btn-primary" href="{{route('admin.order.agency.new', $user->id)}}">New Orders</a>
                <a class="btn btn-primary" href="{{route('admin.order.agency.active', $user->id)}}">Active Orders</a>
                <a class="btn btn-primary" href="{{route('admin.order.agency.completed', $user->id)}}">Completed Orders</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @foreach($user->clients as $client)
                @foreach($client->orders as $order)
                    @if (isset($current_status))
                        @if($current_status->id == $order->status->id)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row" style="line-height: 32px;">
                                        <div class="col-md-6">
                                            <span>Order #{{$order->id}} (<strong>{{$client->business_name}}</strong>)</span>

                                            <div class="form-inline">
                                                <label for="order_status" class="bg-color-blue">Status:</label>
                                                <select name="order_status" class="order_status form-control" data-order-id="{{$order->id}}">
                                                    @foreach($statuses as $status)
                                                        @if($order->status->id == $status->id)
                                                            <option selected value="{{$status->id}}">{{$status->name}}</option>
                                                        @else
                                                            <option value="{{$status->id}}">{{$status->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <span id="status-saved-{{$order->id}}" class="status-saved btn btn-success glyphicon glyphicon-floppy-saved"></span>
                                            </div>

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
                        @endif
                    @else
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row" style="line-height: 32px;">
                                    <div class="col-md-6">
                                        <span>Order #{{$order->id}} (<strong>{{$client->business_name}}</strong>)</span>

                                        <div class="form-inline">
                                            <label for="order_status" class="bg-color-blue">Status:</label>
                                            <select name="order_status" class="order_status form-control" data-order-id="{{$order->id}}">
                                                @foreach($statuses as $status)
                                                    @if($order->status->id == $status->id)
                                                        <option selected value="{{$status->id}}">{{$status->name}}</option>
                                                    @else
                                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span id="status-saved-{{$order->id}}" class="status-saved btn btn-success glyphicon glyphicon-floppy-saved"></span>
                                        </div>

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
                                            @if($order->price_discount)
                                                <div style="text-align: right;">
                                                    <i>Total With Discount: </i>
                                                    <span class="glyphicon glyphicon-usd"></span>
                                                    <strong>{{$order->price_discount}}</strong>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
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
                @if (isset($title))
                    <span> › </span>
                    <li property="itemListElement" typeof="ListItem">
                        <a property="item" typeof="WebPage" href="#">
                            <span property="name">{{$title}}</span>
                        </a>
                        <meta property="position" content="5">
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
            var order_id = $(this).attr("data-order-id");
            var token = "{{ csrf_token() }}";
            var url = "{{route('admin.orders.change.status')}}";
            $.ajax({
                type: "POST",
                url: url,
                data: {status_id:status_id, order_id:order_id, _token:token},
                success: function(data) {
                    $('#status-saved-'+order_id).show().css({
                        "opacity" : "1",
                        "transition" : "opacity 2s ease-in-out"
                    });
                }
            });
        });
    </script>

@endsection
