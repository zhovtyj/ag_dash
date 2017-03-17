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
            <div class="col-md-6">
                <span>Order #{{$order->id}} (<strong>{{$order->client->business_name}}</strong>)</span>

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
</body>
</html>


