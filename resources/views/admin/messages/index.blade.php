@extends('admin.main')

@section('title', 'Messages')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Messages
            </h1>
        </div>
    </div>


    <div class="container" id="app">
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div id="user-name" style="display:none">{{Auth::user()->name}}</div>
                        <span class="glyphicon glyphicon-comment"></span> Chat
                        <span class="badge">@{{usersInRoom.length}}</span>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </button>
                            <ul class="dropdown-menu slidedown">
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
                            </span>Refresh</a></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-ok-sign">
                            </span>Available</a></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-remove">
                            </span>Busy</a></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-time"></span>
                                        Away</a></li>
                                <li class="divider"></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-off"></span>
                                        Sign Out</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="panel-body">

                        <chat-log :messages="messages"></chat-log>

                    </div>
                    <div class="panel-footer">

                        <chat-composer v-on:messagesent="addMessage"></chat-composer>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .chat
        {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li
        {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li.left .chat-body
        {
            margin-left: 60px;
        }

        .chat li.right .chat-body
        {
            margin-right: 60px;
        }


        .chat li .chat-body p
        {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon
        {
            margin-right: 5px;
        }

        .panel-body
        {
            overflow-y: scroll;
            height: 250px;
        }

        ::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }

    </style>



@endsection

@section('javascript')
    <!-- Laravel Js -->
    <script src="/js/app.js" charset="utf-8"></script>

@endsection