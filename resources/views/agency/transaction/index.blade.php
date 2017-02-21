@extends('agency.main')

@section('title', 'Transactions')

@section('content')

    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                <span class="glyphicon glyphicon-transfer"></span>
                All Transactions
            </h1>
        </div>
        <div class="col-md-3">
            <button class="btn btn-block btn-danger" style="margin-top:20px;">
                Balance:
                <span class="glyphicon glyphicon-usd"></span>
                <strong>
                    @if(isset(Auth::user()->deposit->balance ))
                        {{Auth::user()->deposit->balance }}
                    @else
                        0.00
                    @endif
                </strong>
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover" id="dataTables-transactions">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Balance</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$transaction->created_at}}</td>
                        <td>{{$transaction->name}}</td>
                        <td>{{$transaction->last_value - $transaction->first_value}}</td>
                        <td>{{$transaction->last_value}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
            $('#dataTables-transactions').dataTable();
        });
    </script>
@endsection


