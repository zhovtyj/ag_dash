@extends('admin.main')

@section('title', 'All Coupons')



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                All Coupons
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Coupons Table
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-coupons">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Code</th>
                                <th>Discount</th>
                                <th>Used</th>
                                <th>Expired In</th>
                                <th>Created At</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$coupon->user->name}}</td>
                                    <td>{{$coupon->code}}</td>
                                    <td>{{$coupon->discount}}</td>
                                    <td>{{$coupon->used}}</td>
                                    <td>{{$coupon->expired_in}}</td>
                                    <td>{{$coupon->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-gift"> </span> Create New Coupon
                </div>
                {!! Form::open(['route' => 'coupons.store', 'method'=>'post']) !!}
                <div class="panel-body">

                    <div class="form-group">
                        <label for="user_id">User:</label>
                        <select name="user_id" class="select-user form-control" required>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount %:</label>
                        <input type="number" name="discount" class="form-control" min="1" max="99" required>
                    </div>

                    <div class="form-group">
                        <label for="expired_in">Expired In:</label>
                        <input type="date" name="expired_in" class="form-control" required>
                    </div>

                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-4 col-lg-offset-8">
                            <button type="submit" class="btn btn-success btn-block">Create</button>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('stylesheets')
    <!-- TABLE STYLES-->
    <link href="/admin-assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    {!! Html::style('css/select2.min.css') !!}
@endsection

@section('javascript')
    <!-- DATA TABLE SCRIPTS -->
    <script src="/admin-assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="/admin-assets/js/dataTables/dataTables.bootstrap.js"></script>
    {!! Html::script('js/select2.full.js') !!}
    <script>
        $(document).ready(function () {
            $('#dataTables-coupons').dataTable();
        });
    </script>

    <script type="text/javascript">
        $('.select-user').select2();
    </script>
@endsection

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
                    <a property="item" typeof="WebPage" href="{{ route('coupons.index') }}">
                        <span property="name">All Coupons</span>
                    </a>
                    <meta property="position" content="2">
                </li>
            </ol>
        </div>
    </div>
@endsection
