@extends('agency.main')

@section('title', 'Main')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Dashboard <small>Summary of your App</small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-brown">
                <div class="panel-body">
                    <i class="fa fa-users fa-5x"></i>
                    <h3>{{$clients->count()}} </h3>
                </div>
                <div class="panel-footer back-footer-brown">
                    <a href="{{route('client.index')}}" class="dashboard-links">View Clients</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-blue">
                <div class="panel-body">
                    <i class="fa fa-shopping-cart fa-5x"></i>
                    <h3>{{$services->count()}} </h3>
                </div>
                <div class="panel-footer back-footer-blue">
                    <a href="{{route('home')}}" class="dashboard-links">All Services</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-green">
                <div class="panel-body">
                    <i class="fa fa-bar-chart-o fa-5x"></i>
                    <h3>{{$orders->count()}}</h3>
                </div>
                <div class="panel-footer back-footer-green">
                    <a href="{{route('order.index')}}" class="dashboard-links">Order History</a>

                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-red">
                <div class="panel-body">
                    <i class="fa fa fa-usd fa-5x"></i>
                    <h3>
                        @if(isset(Auth::user()->deposit->balance ))
                            {{Auth::user()->deposit->balance }}
                        @else
                            0.00
                        @endif
                    </h3>
                </div>
                <div class="panel-footer back-footer-red">
                    <a href="{{route('deposit.index')}}" class="dashboard-links">Deposit Funds</a>
                </div>
            </div>
        </div>

    </div>

@endsection


