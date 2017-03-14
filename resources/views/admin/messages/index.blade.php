@extends('admin.messages.main')

@section('title', 'Messages')

@section('content')

    <div class="row chat-container" id="admin-chat">
        <div class="col-md-10">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div id="user-name" style="display:none">{{Auth::user()->name}}</div>
                    <span class="glyphicon glyphicon-comment"></span> Chat
                    <span class="badge">@{{usersInRoom.length}}</span>
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

@endsection

@section('javascript')
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
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
                    console.log('File was uploaded.');
                },
                error: function(data){
                    console.log('File uploading error.');
                }
            });
        });

    </script>


@endsection