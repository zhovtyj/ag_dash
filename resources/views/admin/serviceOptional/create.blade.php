@extends('admin.main')

@section('title', 'Create Optional Service')

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
                    <a property="item" typeof="WebPage" href="{{ route('service-optional.index') }}">
                        <span property="name">All Optional Services</span>
                    </a>
                    <meta property="position" content="2">
                </li>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('service-optional.create') }}">
                        <span property="name">Create New Service</span>
                    </a>
                    <meta property="position" content="3">
                </li>

            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                <span class="glyphicon glyphicon-th-list"></span> Create Optional Service
            </h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            {!! Form::open(['route' => 'service-optional.store', 'files' => 'true']) !!}

            <label for="service_id">Choose the Service</label>
            <select name="service_id" class="form-control">
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}}</option>>
                @endforeach
            </select>

            {{ Form::label('name', 'Name of Optional Service:') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '']) }}

            {{ Form::label('subscription', 'Subscription:') }}
            {{ Form::checkbox('subscription', 1, null) }}

            <ul class="list-group" style="margin-top:20px;">
                <li class="list-group-item">
                    {{ Form::label('description[]', 'Description [1]:') }}
                    {{ Form::text('description[]', null, ['class' => 'form-control', 'required' => '']) }}

                    {{ Form::label('price[]', 'Price [1]:') }}
                    {{ Form::text('price[]', null, ['class' => 'form-control', 'required' => '']) }}
                </li>
                <li id="list-group-item-last-child" class="list-group-item">
                    <button id="add-new-field" class="btn btn-block btn-primary">Add one more description</button>
                </li>

            </ul>

            <div class="row" style="margin-top:20px;">
                <div class="col-md-6">
                {{ Form::submit('Create Option', ['class' => 'btn btn-success btn-lg btn-block']) }}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        var i = 2;
        $('#add-new-field').on('click', function(){
            $('#list-group-item-last-child').before('' +
                '<li class="list-group-item">'+
                    '<label for="description1">Description ['+i+']:</label>' +
                    '<span class="delete-description glyphicon glyphicon glyphicon-remove"></span>'+
                    '<input class="form-control" required="" name="description[]" type="text" id="description['+i+']">'+
                        '<label for="price['+i+']">Price ['+i+']:</label>'+
                    '<input class="form-control" required="" name="price[]" type="text" id="price['+i+']">'+
                '</li>');
            i++;
        });
        $(document).on("click", ".delete-description", function() {
            $(this).parent().remove();
        });
    </script>
@endsection