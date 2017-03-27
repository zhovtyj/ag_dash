@extends('admin.main')

@section('title', 'All Agency')

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
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                All Agency
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Agency Table
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-clients">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Agency Name</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Address</th>
                                <th>Deposit Funds</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ isset($user->userInfo->site) ? $user->userInfo->site : ''}}</td>
                                    <td>{{ isset($user->userInfo->address1) ? $user->userInfo->address1 : ''}}</td>
                                    <td>${{ isset($user->deposit->balance) ? $user->deposit->balance : '0.00'}}</td>
                                    <td>
                                        <a class="btn btn-block btn-primary" href="{{route('admin.client', $user->id)}}"><span class="fa fa-users"></span> Clients</a>
                                        <a class="btn btn-block btn-primary" href="{{route('admin.order.agency', $user->id)}}"><span class="fa fa-edit"></span> Orders</a>
                                        <a class="btn btn-block btn-primary" href="{{route('admin.subscription.agency', $user->id)}}"><span class="glyphicon glyphicon-signal"></span> Subscriptions</a>
                                        <a class="btn btn-block btn-primary" href="{{route('admin.transaction.agency', $user->id)}}"><span class="glyphicon glyphicon-transfer"></span> Transactions</a>
                                        <a class="btn btn-block btn-success" href="{{route('admin.messages.index', $user->id)}}"><span class="glyphicon glyphicon-envelope"></span> Message</a>
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
