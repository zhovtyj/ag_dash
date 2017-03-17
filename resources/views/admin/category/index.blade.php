@extends('admin.main')

@section('title', 'Categories')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                All Categories
            </h1>
        </div>
    </div>

    <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name:</th>
                        <th>Email for Trello Boards:</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    @foreach ($categories as $category)
                        <tbody>
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->email }}</td>
                            <td>
                                {{ Form::open(['route' => ['categories.destroy', $category->id], 'method' =>'DELETE']) }}

                                {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger'])!!}

                                {{ Form::close() }}
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>

            <div class="col-md-4">
                <div class="well">
                    {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
                    <h2>New category</h2>
                    {{ Form::label('name', 'Name:') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}

                    {{ Form::label('email', 'Email for Trello Boards:') }}
                    {{ Form::email('email', null, ['class' => 'form-control']) }}

                    <br>
                    {{ Form::submit('Create', ['class' => 'btn btn-primary btn-block']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection