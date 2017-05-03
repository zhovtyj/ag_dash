@extends('agency.main')

@section('title', 'Manage Accounts')

@section('content')

    <div class="row">

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Filters</div>
                <div class="panel-body">

                    <h3>Status</h3>
                    <div>
                        @foreach($statuses as $status)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status-{{$status->id}}" value="{{$status->name}}" class="filter-checkbox">
                                    {{$status->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <hr>

                    <h3>Tags</h3>
                    <div>
                        @foreach($tags as $tag)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status-{{$tag->id}}" value="{{$tag->name}}" class="filter-checkbox">
                                    {{$tag->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Accounts
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-clients">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Notes</th>
                                <th>Tags</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{$client->business_name}}<br/>
                                        {{$client->address1}},
                                        {{$client->address2}},
                                        {{$client->city}},
                                        {{$client->state}},
                                        {{$client->postcode}},
                                        {{$client->country}}<br/>
                                        {{$client->phone}}<br/>
                                    </td>
                                    <td>
                                        <div id="note-{{$client->id}}">{!! isset($client->note)?$client->note->body:'' !!}</div>
                                    </td>
                                    <td id="td-tags-{{$client->id}}">
                                        @forelse($client->tags as $tag)
                                        <span class="label label-default">{{$tag->name}}</span>
                                        @empty

                                        @endforelse

                                    </td>
                                    <td id="td-status-{{$client->id}}">{{isset($client->clientStatus->name)?$client->clientStatus->name:''}}</td>
                                    <td>
                                        <button class="edit-notes btn btn-primary btn-block" data-client-id="{{$client->id}}" data-toggle="modal" data-target="#edit-notes-modal">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            Edit Notes
                                        </button>

                                        <button class="edit-tags btn btn-primary btn-block" data-client-id="{{$client->id}}" data-toggle="modal" data-target="#edit-tags-modal">
                                            <span class="glyphicon glyphicon-tag"></span>
                                            Edit Tags
                                        </button>

                                        <button class="edit-status btn btn-primary btn-block" data-client-id="{{$client->id}}" data-status-id="{{isset($client->clientStatus->id)?$client->clientStatus->id:''}}" data-toggle="modal" data-target="#edit-status-modal">
                                            <span class="glyphicon glyphicon-stats"></span>
                                            Status
                                        </button>

                                        <button class="email-btn btn btn-primary btn-block" data-client-id="{{$client->id}}" data-toggle="modal" data-target="#email-modal">
                                            <span class="glyphicon glyphicon-envelope"></span>
                                            Email
                                        </button>
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

    <!-- Modal Edit Notes-->
    <div id="edit-notes-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Notes</h4>
                </div>
                {!! Form::open(['url' => 'foo/bar', 'method'=>'post', 'id'=>'edit-notes-form']) !!}
                <div class="modal-body">
                    <input type="hidden" id="client_id" name="client_id" value="">
                    <textarea id="edit-notes-area" name="body"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="note-submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- Modal Edit Tags-->
    <div id="edit-tags-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Tags</h4>
                </div>
                {!! Form::open(['url' => 'foo/bar', 'method'=>'post', 'id'=>'edit-tags-form']) !!}
                <div class="modal-body">
                    <input type="hidden" id="tag_client_id" name="client_id" value="">
                    <div class="form-group">
                        <label for="tags">Select tags:</label>
                        <select name="tags[]" class="select2 form-control" multiple="multiple">
                            @foreach($tags as $tag)
                                <option id="tag-option-{{$tag->id}}" value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tag-submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- Modal Edit Status-->
    <div id="edit-status-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Status</h4>
                </div>
                {!! Form::open(['url' => 'foo/bar', 'method'=>'post', 'id'=>'edit-status-form']) !!}
                <div class="modal-body">
                    <input type="hidden" id="status_client_id" name="client_id" value="">
                    <div class="form-group">
                        <label for="tags">Select Status:</label>
                        <select name="status" id="select-status" class="form-control">
                            @foreach($statuses as $status)
                                <option id="status-option-{{$status->id}}" value="{{$status->id}}" class="form-control">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tag-submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- Modal Email-->
    <div id="email-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Email to Client</h4>
                </div>
                {!! Form::open(['url' => 'foo/bar', 'method'=>'post', 'id'=>'email-form']) !!}
                <div class="modal-body">
                    <input type="hidden" id="email_client_id" name="client_id" value="">
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" name="subject" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea name="message" class="message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tag-submit" class="btn btn-success">Send Email</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection


@section('javascript')
    <!-- DATA TABLE SCRIPTS -->
    <script src="/admin-assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="/admin-assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    {!! Html::script('js/select2.full.js') !!}

    <script type="text/javascript">
        //dataTables
        $(document).ready(function () {
             table = $('#dataTables-clients').DataTable({
                "pageLength": 50
            });
        });

        //Edit Notes
        $('.edit-notes').on('click', function(){
            id = $(this).attr('data-client-id');
            var note = $('#note-'+id).text();
            $('#edit-notes-area').text(note);
            $('#client_id').val(id);

            tinymce.init({
                selector:'textarea',
                plugins:'link code',
                height:'300',
                setup: function (editor) {
                    editor.on('change', function () {
                        tinymce.triggerSave();
                    });
                }
            });
            tinyMCE.activeEditor.setContent(note);
        });

        //Save Notes
        $('#edit-notes-form').on('submit', function(e){
            e.preventDefault();
            var url = "{{route('manage-accounts.notes-store')}}";
            var data = $( this ).serialize();
            $('#note-'+id).html(tinyMCE.activeEditor.getContent());
            $("#edit-notes-form").trigger('reset');

            tinyMCE.activeEditor.setContent('');

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    console.log(data);
                }
            });

            $('#edit-notes-modal').modal('hide');
        });

        //Edit Tags
        $('.edit-tags').on('click', function(){
            var url = "{{route('manage-accounts.client-ajax')}}";
            var token = "{{ csrf_token() }}";
            id = $(this).attr('data-client-id');
            $('#tag_client_id').val(id);
            $('.select2 option').removeAttr('selected');
            $.ajax({
                type: "POST",
                url: url,
                data: {id:id, _token:token},
                success: function(data) {
                    data.forEach(function(tag) {
                        $('#tag-option-'+tag.id).attr('selected', 'selected');
                    });
                    $('.select2').select2();
                }
            });
        });

        //Save Tags
        $('#edit-tags-form').on('submit', function(e){
            e.preventDefault();
            var url = "{{route('manage-accounts.tags-store')}}";
            var data = $( this ).serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    $('#td-tags-'+id).html('');
                    data.forEach(function(tag) {
                        $('#td-tags-'+id).append('<span class="label label-default">'+tag.name+'</span> ')
                    });
                }
            });

            $('#edit-tags-modal').modal('hide');
        });

        //Edit Status
        $('.edit-status').on('click', function(){
            id = $(this).attr('data-client-id');
            status_id = $(this).attr('data-status-id');
            $('#select-status option').removeAttr('selected');
            $('#status-option-'+status_id).attr('selected', 'selected');
            $('#status_client_id').val(id);
        });

        //Save Status
        $('#edit-status-form').on('submit', function(e){
            e.preventDefault();
            var url = "{{route('manage-accounts.status-store')}}";
            var data = $( this ).serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    $('#td-status-'+id).html(data);

                }
            });

            $('#edit-status-modal').modal('hide');
        });

        //Filter
        var filterString = '';
        $('.filter-checkbox').on('change', function(){
            if((this.checked)){
                filterString += ' '+this.value;
            }else{
                filterString = filterString.replace(this.value, " ");
            }
            console.log(filterString);
            $('#dataTables-clients').DataTable().search( filterString ).draw();
        });

        //Email to Client
        $('.email-btn').on('click', function(){
            id = $(this).attr('data-client-id');
            $('#email_client_id').val(id);
            tinymce.init({
                selector:'.message',
                plugins:'link code',
                height:'200',
            });
        });

        //Send Email
        $('#email-form').on('submit', function(e){
            e.preventDefault();
            var url = "{{route('manage-accounts.send-email')}}";
            var data = $( this ).serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    console.log(data);
                }
            });

            $('#email-form').modal('hide');
        });

    </script>
@endsection

@section('stylesheets')
    <!-- TABLE STYLES-->
    <link href="/admin-assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    {!! Html::style('css/select2.min.css') !!}
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
                    <a property="item" typeof="WebPage" href="{{ route('manage-accounts') }}">
                        <span property="name">Manage Accounts</span>
                    </a>
                    <meta property="position" content="2">
                </li>
            </ol>
        </div>
    </div>
@endsection