@extends('agency.main')

@section('title', 'All Clients')

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
                    <a property="item" typeof="WebPage" href="{{ route('client.index') }}">
                        <span property="name">All Clients</span>
                    </a>
                    <meta property="position" content="2">
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                All Clients
            </h1>
        </div>
        <div class="col-md-3">
            <a href="{{route('client.create')}}" class="btn btn-lg btn-block btn-primary" style="margin-top:20px;"><span class="glyphicon glyphicon-pencil"> </span> Add New Client</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Clients Table
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-clients">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Business Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->id}}</td>
                                    <td>{{$client->business_name}}</td>
                                    <td>
                                        {{$client->address1}},
                                        {{$client->address2}},
                                        {{$client->city}},
                                        {{$client->state}},
                                        {{$client->postcode}},
                                        {{$client->country}},
                                    </td>
                                    <td>{{$client->business_owners_email}}</td>
                                    <td>{{$client->business_website}}</td>
                                    <td>

                                        <a class="btn btn-success btn-block" href="{{route('agency.service.index', $client->id)}}" title="Order New Service">
                                            <span class="glyphicon glyphicon-plus" style="color:#fff"></span>
                                        </a>

                                        <a class="btn btn-success btn-block" href="{{route('order.orders', $client->id)}}" title="See all Orders">
                                            <span class="glyphicon glyphicon-th-list" style="color:#fff"></span>
                                        </a>

                                        <a class="btn btn-success btn-block" href="{{ route('subscription.client', $client->id) }}" title="See all Subscriptions">
                                            <span class="glyphicon glyphicon-signal" style="color:#fff"></span>
                                        </a>

                                        <a class="btn btn-primary btn-block" href="{{route('client.show', $client->id)}}" title="Show">
                                            <span class="glyphicon glyphicon-eye-open" style="color:#fff"> </span>
                                        </a>

                                        <a class="btn btn-primary btn-block" href="{{route('client.edit', $client->id)}}" title="Edit">
                                            <span class="glyphicon glyphicon-edit" style="color:#fff"> </span>
                                        </a>

                                        {{ Form::open(['route' => ['client.destroy', $client->id], 'method' =>'DELETE']) }}
                                            <button type="submit" class="btn btn-danger btn-block" style="margin-top:5px;"><span class="glyphicon glyphicon-trash"> </span> </button>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>

@endsection

@section('stylesheets')
    <!-- TABLE STYLES-->
    <link href="/admin-assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
@endsection

@section('javascript')
    <!-- DATA TABLE SCRIPTS -->
    <script src="/admin-assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="/admin-assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-clients').dataTable();
        });
    </script>
@endsection
