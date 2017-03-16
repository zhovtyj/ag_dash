@extends('admin.main')

@section('title', 'Admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Admin <small>dashboard</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-green">
                <div class="panel-body">
                    <i class="fa fa-bar-chart-o fa-5x"></i>
                    <h3>{{$count['service']}}</h3>
                </div>
                <div class="panel-footer back-footer-green">
                    No. of Services

                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-brown">
                <div class="panel-body">
                    <i class="fa fa-users fa-5x"></i>
                    <h3>{{$count['user']}} </h3>
                </div>
                <div class="panel-footer back-footer-brown">
                    No. of Agency
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-blue">
                <div class="panel-body">
                    <i class="fa fa-user fa-5x"></i>
                    <h3>{{$count['client']}} </h3>
                </div>
                <div class="panel-footer back-footer-blue">
                    No. of Clients

                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-red">
                <div class="panel-body">
                    <i class="fa fa fa-comments fa-5x"></i>
                    <h3>15,823 </h3>
                </div>
                <div class="panel-footer back-footer-red">
                    No. of Orders

                </div>
            </div>
        </div>

    </div>

@endsection