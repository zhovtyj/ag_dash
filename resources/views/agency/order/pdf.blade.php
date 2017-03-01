<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Order PDF</title>
    <!-- Bootstrap -->
    <link href="/admin-assets/css/bootstrap.css" rel="stylesheet" />


</head>
<body>
    <header class="clearfix">
        @if(isset($order->client->user->userInfo->logo))
            <div id="logo">
                <img src='{!! url('/upload_images/users/'.$order->client->user->userInfo->logo) !!}' />
            </div>
        @endif
        <h1>INVOICE #{{$order->id}}</h1>
        <table>
            <tr>
                <td id="project" style="text-align: left">
                    <div><span>PROJECT</span> {{$order->client->business_name}}</div>
                    <div><span>CLIENT</span> {{$order->client->business_owners_name}}</div>
                    <div>
                        <span>ADDRESS</span>
                        {{$order->client->address1}}, {{$order->client->address2}}
                    </div>
                    <div>
                        <span>CITY/STATE</span>
                        {{$order->client->city}}/{{$order->client->state}}
                    </div>
                    <div>
                        <span>POSTCODE</span>
                        {{$order->client->postcode}}
                    </div>
                    <div>
                        <span>COUNTRY</span>
                        {{$order->client->country}}
                    </div>
                    <div><span>PHONE</span> {{$order->client->business_owners_phone}}</div>
                    <div>
                        <span>EMAIL</span>
                        <a href="mailto:{{$order->client->business_owners_email}}">{{$order->client->business_owners_email}}</a>
                    </div>
                    <div><span>DATE</span> {{$order->created_at}}</div>
                    {{--<div><span>DUE DATE</span> September 17, 2015</div>--}}
                </td>
                <td id="company" class="clearfix">
                    <div>{{$order->client->user->name}}</div>
                    @if(isset($order->client->user->userInfo->agency_email))
                        <div><a href="mailto:{{$order->client->user->userInfo->agency_email}}">{{$order->client->user->userInfo->agency_email}}</a></div>
                    @else
                        <div><a href="mailto:{{$order->client->user->email}}">{{$order->client->user->email}}</a></div>
                    @endif
                    <div>{{$order->client->user->userInfo->phone}}</div>
                    <div>{{$order->client->user->userInfo->address1}}</div>
                    <div>{{$order->client->user->userInfo->city}}</div>
                    <div>{{$order->client->user->userInfo->state}}</div>
                    <div>{{$order->client->user->userInfo->postcode}}</div>
                    <div>{{$order->client->user->userInfo->country}}</div>
                </td>
            </tr>
        </table>
    </header>
    <main>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Service</th>
                <th>Service Price</th>
                <th>Additional Services</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->orderServices as $orderService)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $orderService->service->name }}</strong></td>
                    <td><strong>$ {{ $orderService->service->price }}</strong></td>
                    <td>
                        <?php $order_item_total_price = 0;?>
                        @if(isset($orderService->orderServiceOptionals))
                            @foreach($orderService->orderServiceOptionals as $orderServiceOptional)
                                <?php $order_item_total_price += $orderServiceOptional->serviceOptionalDescription->price; ?>
                                <div style="position:relative">
                                    {{$orderServiceOptional->serviceOptionalDescription->description}}
                                    <span style="position:absolute; right:0">${{$orderServiceOptional->serviceOptionalDescription->price}}</span>
                                </div>
                            @endforeach
                        @endif
                    </td>
                    <td>${{$order_item_total_price+$orderService->service->price}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5">
                    <div style="text-align: right;">
                        <i>Total: </i>
                        $<strong>{{$order->price}}</strong></div>
                </td>
            </tr>
            </tbody>
        </table>
        <div id="notices">
            <!--<div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>-->
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 100%;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 1em;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: left;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: left;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

    </style>
</body>
</html>