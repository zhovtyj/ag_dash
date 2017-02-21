@extends('agency.main')

@section('title', 'Deposit Funds')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                <span class="glyphicon glyphicon-usd"></span>
                Deposit Funds
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
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Pay for Deposit Funds</h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['deposit.Checkout'], 'data-parsley-validate' =>'', 'method' =>'POST']) !!}

                    <div class="row">
                        <div class="col-md-6">

                            {{ Form::label('pay', 'Amount($):') }}
                            {{ Form::text('pay', null, ['class' => 'form-control', 'required' => '', 'data-parsley-type'=>'number']) }}

                            <button type="submit" class="btn btn-success btn-block" style="margin-top: 10px;">Pay with PayPal</button>

                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    {!! Html::script('js/parsley.min.js') !!}
@endsection


