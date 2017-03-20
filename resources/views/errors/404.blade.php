@extends('main')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel-login" style="background: transparent;">
                    <h1 style="text-align:center">404 Error</h1>
                </div>
            </div>
        </div>
    </div>

    <style>
        body{
            overflow:hidden;
        }
        .panel-login{
            margin-top:18vh;
            background:rgba(255,255,255,0.9);
        }
        .panel-heading{
            font-size:1.2em;
            color:#c30000;
        }
    </style>
@endsection
