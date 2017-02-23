@extends('agency.main')

@section('title', 'Edit Profile')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Edit Profile
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <h2>General Information:</h2>
            <br/>
            {!! Form::model($user, ['route' => ['user.update'], 'method' => 'PUT', 'files' => 'true', 'class'=>'form-horizontal']) !!}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Agency Name:</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address:</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6 col-md-offset-4">
                {{ Form::submit('Save changes', ['class' => 'btn btn-success btn-block']) }}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <h2>Password:</h2>
            {!! Form::open(['route' => ['password.update'], 'method' => 'PUT', 'class'=>'form-horizontal']) !!}

            <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                <label for="old_password" class="col-md-4 control-label">Old Password:</label>

                <div class="col-md-6">
                    <input id="old_password" type="password" class="form-control" name="old_password" required>

                    @if ($errors->has('old_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('old_password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">New Password:</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password:</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-4">
                {{ Form::submit('Change Password', ['class' => 'btn btn-success btn-block']) }}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection


