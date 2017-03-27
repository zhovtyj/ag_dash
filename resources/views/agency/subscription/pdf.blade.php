<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Subscription Order PDF</title>
    <!-- Bootstrap -->
    <link href="/admin-assets/css/bootstrap.css" rel="stylesheet" />


</head>
<body>
    <header class="clearfix">
        @if(isset($subscription->client->user->userInfo->logo))
            <div id="logo">
                <img src='{!! url('/upload_images/users/'.$subscription->client->user->userInfo->logo) !!}' />
            </div>
        @endif
        <h1>INVOICE #{{$subscription->id}}</h1>
        <table>
            <tr>
                <td id="project" style="text-align: left">
                    <div><span>PROJECT</span> {{$subscription->client->business_name}}</div>
                    <div><span>CLIENT</span> {{$subscription->client->business_owners_name}}</div>
                    <div>
                        <span>ADDRESS</span>
                        {{$subscription->client->address1}}, {{$subscription->client->address2}}
                    </div>
                    <div>
                        <span>CITY/STATE</span>
                        {{$subscription->client->city}}/{{$subscription->client->state}}
                    </div>
                    <div>
                        <span>POSTCODE</span>
                        {{$subscription->client->postcode}}
                    </div>
                    <div>
                        <span>COUNTRY</span>
                        {{$subscription->client->country}}
                    </div>
                    <div><span>PHONE</span> {{$subscription->client->business_owners_phone}}</div>
                    <div>
                        <span>EMAIL</span>
                        <a href="mailto:{{$subscription->client->business_owners_email}}">{{$subscription->client->business_owners_email}}</a>
                    </div>
                    <div><span>DATE</span> {{$subscription->created_at}}</div>
                    {{--<div><span>DUE DATE</span> September 17, 2015</div>--}}
                </td>
                <td id="company" class="clearfix">
                    <div>{{$subscription->client->user->name}}</div>
                    <div><a href="mailto:{{$subscription->client->user->email}}">{{$subscription->client->user->email}}</a></div>
                    <div>{{isset($subscription->client->user->userInfo->site)? $subscription->client->user->userInfo->site :''}}</div>
                    <div>{{isset($subscription->client->user->userInfo->phone)? $subscription->client->user->userInfo->phone :''}}</div>
                    <div>{{isset($subscription->client->user->userInfo->address1)? $subscription->client->user->userInfo->address1 :'' }}</div>
                    <div>{{isset($subscription->client->user->userInfo->city)? $subscription->client->user->userInfo->city:'' }}</div>
                    <div>{{isset($subscription->client->user->userInfo->state)? $subscription->client->user->userInfo->state:'' }}</div>
                    <div>{{isset($subscription->client->user->userInfo->postcode)? $subscription->client->user->userInfo->postcode:'' }}</div>
                    <div>{{isset($subscription->client->user->userInfo->country)? $subscription->client->user->userInfo->country:'' }}</div>
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
                <th style="text-align: right;">Total Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subscription->subscriptionServices as $subscriptionService)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $subscriptionService->service->name }}</strong></td>
                    <td><strong>$ {{ $subscriptionService->service->price }}</strong></td>
                    <td>
                        <?php $order_item_total_price = 0;?>
                        @if(isset($subscriptionService->subscriptionServiceOptionals))
                            @foreach($subscriptionService->subscriptionServiceOptionals as $subscriptionServiceOptional)
                                <?php $order_item_total_price += $subscriptionServiceOptional->price; ?>
                                <div style="position:relative">
                                    {{$subscriptionServiceOptional->serviceOptionalDescription->description}}
                                    <span style="position:absolute; right:0">${{$subscriptionServiceOptional->price}}</span>
                                </div>
                            @endforeach
                        @endif
                    </td>
                    <td style="text-align: right;">${{$order_item_total_price+$subscriptionService->price}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5">
                    <div style="text-align: right;">
                        <i>Total: </i>
                        $<strong>{{$subscription->first_price}}</strong></div>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div style="text-align: right;">
                        <i>Monthly Price: </i>
                        $<strong>{{$subscription->monthly_price}}</strong></div>
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