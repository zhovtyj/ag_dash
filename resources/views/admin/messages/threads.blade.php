@extends('admin.main')

@section('title', 'All Messages')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                 All Messages
            </h1>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="threads-container">
                <div class="threads-header">
                    <strong>{{count($threads)}} conversations | {{$unread}} unread messages</strong>
                </div>
                <div class="threads-body">
                    @foreach($threads as $thread)
                        <div class="thread row">
                            <div class="col-md-4">
                                <div class="avatar-container">
                                    <img src="/upload_images/users/{{isset($thread->user->userInfo->logo) ? $thread->user->userInfo->logo : 'no-logo.png'}}" alt="User logo">
                                </div>
                                <div class="thread-info-cont">
                                    <div class="thread-info">
                                        <div><strong>{{$thread->user->name}}</strong></div>
                                        <div class="thread-info-time"><small><span class="glyphicon glyphicon-time"></span> {{$thread->created_at}}</small> </div>
                                        <div>
                                            @if($thread->unread == 1)
                                                <strong class="thread-new-message">New</strong>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <a href="{{route('admin.messages.index', $thread->user->id)}}">
                                    <div class="thread-message">{{$thread->message}}</div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .threads-container{
            background: #fff;
        }
        .threads-header{
            padding:10px;
            border-bottom:1px solid #ccc;
        }
        .threads-body{

        }
        .thread{
            margin:5px 0;
            padding:10px;
            border-bottom:1px dotted #eaeaea;
        }
        .avatar-container{
            width:100px;
            float:left;
        }
        .avatar-container img{
            width:100%;
            display:block;
        }
        .thread-info-cont{
            height:100px;
            float:left;
            margin-left:15px;
            padding:20px 0;
        }
        .thread-info-time{
            color:#a0a0a0;
        }
        .thread-message{
            font-size:1.2em;
            font-style:italic;
        }
        .thread-new-message{
            color:#168400;
        }


    </style>



@endsection