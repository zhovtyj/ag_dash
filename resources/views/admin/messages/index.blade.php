@extends('admin.main')

@section('title', 'Messages')

@section('content')

    <div class="row" id="admin-chat">
        <div class="col-md-10">
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

    <!-- Modal Select file -->
    <div id="select-file" class="modal fade" role="dialog">
        <div class="modal-dialog">

        {!! Form::open(['url' => '#', 'files' => 'true', 'id'=>'form-file-upload']) !!}
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send File</h4>
                </div>
                <div class="modal-body">
                    {{ Form::file('document') }}
                </div>
                <div class="modal-footer">
                    <button type="button" id="send-file" class="btn btn-primary" data-dismiss="modal">Send</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            {!! Form::close() !!}

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
        .img-circle{
            width: 50px;
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
            height: 500px;
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
    <script>
        var agency_id = {{$agency->id}};
    </script>
    <!-- Laravel Js -->
    <script src="/js/app.js" charset="utf-8"></script>
    <script>
        $('#send-file').on('click', function(){
            $.ajax({
                url: '{{route('messages.fileupload', $agency->id)}}',
                data:new FormData($('#form-file-upload')[0]),
                type:'post',
                processData: false,
                contentType: false,
                success: function(data){
                    //Close Modal
                    $('#select-file').modal('hide');
                    //Clean Input
                    $('#form-file-upload').trigger( 'reset' );
                    //$('#message').val('<a href="/public/'+data.path+'" target="_blank">'+data.filename+'</a>');
                    console.log('File was uploaded.');
                },
                error: function(data){
                    console.log('File uploading error.');
                }
            });
        });

    </script>


@endsection