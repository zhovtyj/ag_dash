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
        <div id="logo">
            <img src='data:image/jpeg;base64,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AAAAAABCbCAgZG91YkBv4AAAAAAAAAAAAEJyZFRVbnRGI1JsdAAAAAAAAAAAAAAAAEJsZCBVbnRGI1JsdAAAAAAAAAAAAAAAAFJzbHRVbnRGI1B4bEBSAAAAAAAAAAAACnZlY3RvckRhdGFib29sAQAAAABQZ1BzZW51bQAAAABQZ1BzAAAAAFBnUEMAAAAATGVmdFVudEYjUmx0AAAAAAAAAAAAAAAAVG9wIFVudEYjUmx0AAAAAAAAAAAAAAAAU2NsIFVudEYjUHJjQFkAAAAAAAA4QklNA+0AAAAAABAASAAAAAEAAgBIAAAAAQACOEJJTQQmAAAAAAAOAAAAAAAAAAAAAD+AAAA4QklNBA0AAAAAAAQAAAB4OEJJTQQZAAAAAAAEAAAAHjhCSU0D8wAAAAAACQAAAAAAAAAAAQA4QklNJxAAAAAAAAoAAQAAAAAAAAACOEJJTQP1AAAAAABIAC9mZgABAGxmZgAGAAAAAAABAC9mZgABAKGZmgAGAAAAAAABADIAAAABAFoAAAAGAAAAAAABADUAAAABAC0AAAAGAAAAAAABOEJJTQP4AAAAAABwAAD/////////////////////////////A+gAAAAA/////////////////////////////wPoAAAAAP////////////////////////////8D6AAAAAD/////////////////////////////A+gAADhCSU0EAAAAAAAAAgABOEJJTQQCAAAAAAAEAAAAADhCSU0EMAAAAAAAAgEBOEJJTQQtAAAAAAAGAAEAAAACOEJJTQQIAAAAAAAQAAAAAQAAAkAAAAJAAAAAADhCSU0EHgAAAAAABAAAAAA4QklNBBoAAAAAA0sAAAAGAAAAAAAAAAAAAAAqAAAAwwAAAAsEEQQ1BDcAIAQ4BDwENQQ9BDgALQAxAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAADDAAAAKgAAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAAAAAABAAAAABAAAAAAAAbnVsbAAAAAIAAAAGYm91bmRzT2JqYwAAAAEAAAAAAABSY3QxAAAABAAAAABUb3AgbG9uZwAAAAAAAAAATGVmdGxvbmcAAAAAAAAAAEJ0b21sb25nAAAAKgAAAABSZ2h0bG9u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YgBlACAAUABoAG8AdABvAHMAaABvAHAAIABDAFMANQAAAAEAOEJJTQ+gAAAAAAD4bWFuaUlSRlIAAADsOEJJTUFuRHMAAADMAAAAEAAAAAEAAAAAAABudWxsAAAAAwAAAABBRlN0bG9uZwAAAAAAAAAARnJJblZsTHMAAAABT2JqYwAAAAEAAAAAAABudWxsAAAAAQAAAABGcklEbG9uZ0Ok3k4AAAAARlN0c1ZsTHMAAAABT2JqYwAAAAEAAAAAAABudWxsAAAABAAAAABGc0lEbG9uZwAAAAAAAAAAQUZybWxvbmcAAAAAAAAAAEZzRnJWbExzAAAAAWxvbmdDpN5OAAAAAExDbnRsb25nAAAAAAAAOEJJTVJvbGwAAAAIAAAAAAAAAAA4QklND6EAAAAAABxtZnJpAAAAAgAAABAAAAABAAAAAAAAAAEAAAAAOEJJTQQGAAAAAAAHAAQAAAABAQD/4RB9aHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjAtYzA2MCA2MS4xMzQ3NzcsIDIwMTAvMDIvMTItMTc6MzI6MDAgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IFdpbmRvd3MiIHhtcDpDcmVhdGVEYXRlPSIyMDE3LTAyLTIzVDE2OjUwOjUzKzAyOjAwIiB4bXA6TWV0YWRhdGFEYXRlPSIyMDE3LTAyLTIzVDE2OjUxOjEzKzAyOjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAxNy0wMi0yM1QxNjo1MToxMyswMjowMCIgZGM6Zm9ybWF0PSJpbWFnZS9qcGVnIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkU1QTZCMjc5RDdGOUU2MTE4Q0QzQzVCOURCMkM4MEZCIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkUzQTZCMjc5RDdGOUU2MTE4Q0QzQzVCOURCMkM4MEZCIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6RTNBNkIyNzlEN0Y5RTYxMThDRDNDNUI5REIyQzgwRkIiIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJBZG9iZSBSR0IgKDE5OTgpIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDpFM0E2QjI3OUQ3RjlFNjExOENEM0M1QjlEQjJDODBGQiIgc3RFdnQ6d2hlbj0iMjAxNy0wMi0yM1QxNjo1MDo1MyswMjowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDpFNEE2QjI3OUQ3RjlFNjExOENEM0M1QjlEQjJDODBGQiIgc3RFdnQ6d2hlbj0iMjAxNy0wMi0yM1QxNjo1MToxMyswMjowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjb252ZXJ0ZWQiIHN0RXZ0OnBhcmFtZXRlcnM9ImZyb20gYXBwbGljYXRpb24vdm5kLmFkb2JlLnBob3Rvc2hvcCB0byBpbWFnZS9qcGVnIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJkZXJpdmVkIiBzdEV2dDpwYXJhbWV0ZXJzPSJjb252ZXJ0ZWQgZnJvbSBhcHBsaWNhdGlvbi92bmQuYWRvYmUucGhvdG9zaG9wIHRvIGltYWdlL2pwZWciLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOkU1QTZCMjc5RDdGOUU2MTE4Q0QzQzVCOURCMkM4MEZCIiBzdEV2dDp3aGVuPSIyMDE3LTAyLTIzVDE2OjUxOjEzKzAyOjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgQ1M1IFdpbmRvd3MiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkU0QTZCMjc5RDdGOUU2MTE4Q0QzQzVCOURCMkM4MEZCIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkUzQTZCMjc5RDdGOUU2MTE4Q0QzQzVCOURCMkM4MEZCIiBzdFJlZjpvcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6RTNBNkIyNzlEN0Y5RTYxMThDRDNDNUI5REIyQzgwRkIiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg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' />
        </div>
        <h1>INVOICE #{{$order->id}}</h1>
        <table>
            <tr>
                <td id="project" style="text-align: left">
                    <div><span>PROJECT</span> {{$order->client->business_name}}</div>
                    <div><span>CLIENT</span> {{$order->client->business_owners_name}}</div>
                    <div><span>ADDRESS</span> {{$order->client->address1}}, {{$order->client->address2}}</div>
                    <div><span>PHONE</span> {{$order->client->business_owners_phone}}</div>
                    <div><span>EMAIL</span> <a href="mailto:{{$order->client->business_owners_email}}">{{$order->client->business_owners_email}}</a></div>
                    <div><span>DATE</span> {{$order->created_at}}</div>
                    {{--<div><span>DUE DATE</span> September 17, 2015</div>--}}
                </td>
                <td id="company" class="clearfix">
                    <div>{{$order->client->user->name}}</div>
                    <!--<div>455 Foggy Heights,<br /> AZ 85004, US</div>
                    <div>(602) 519-0450</div>-->
                    <div><a href="mailto:{{$order->client->user->name}}">{{$order->client->user->email}}</a></div>
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