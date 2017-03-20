<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Irank Dashboard</title>
<body>
<h1>New Order</h1>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row" style="line-height: 32px;">
            <div class="col-md-4">
                <span>Order #{{$order->id}} (<strong>{{$order->client->business_name}}</strong>)</span>
            </div>
            <div class="col-md-6" style="text-align: right">
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
                @if($orderService->service->category->id == $category_id)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{url('/')}}/upload_images/services/{{ $orderService->service->image }}" style="width:250px;"></td>

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
                @endif
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
</body>
</html>