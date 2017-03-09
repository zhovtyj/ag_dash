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
                    No. of Clients

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
                    Deposit Balance

                </div>
            </div>
        </div>
        <!--<div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-green">
                <div class="panel-body">
                    <i class="fa fa-bar-chart-o fa-5x"></i>
                    <h3>8,457</h3>
                </div>
                <div class="panel-footer back-footer-green">
                    Daily Visits

                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-blue">
                <div class="panel-body">
                    <i class="fa fa-shopping-cart fa-5x"></i>
                    <h3>52,160 </h3>
                </div>
                <div class="panel-footer back-footer-blue">
                    Sales

                </div>
            </div>
        </div>-->
    </div>

@endsection


