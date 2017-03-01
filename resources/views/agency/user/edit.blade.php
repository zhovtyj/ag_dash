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

            <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                <label for="site" class="col-md-4 control-label">Website:</label>

                <div class="col-md-6">
                    <input id="site" type="text" class="form-control" name="site" value="{{ isset($user->userInfo->site) ? $user->userInfo->site : '' }}">

                    @if ($errors->has('site'))
                        <span class="help-block">
                            <strong>{{ $errors->first('site') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-md-4 control-label">Phone:</label>

                <div class="col-md-6">
                    <input id="phone" type="phone" class="form-control" name="phone" value="{{ isset($user->userInfo->phone) ? $user->userInfo->phone : '' }}">

                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                <label for="address1" class="col-md-4 control-label">Address:</label>

                <div class="col-md-6">
                    <input id="address1" type="address1" class="form-control" name="address1" value="{{ isset($user->userInfo->address1) ? $user->userInfo->address1 : '' }}">

                    @if ($errors->has('address1'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address1') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                <label for="city" class="col-md-4 control-label">City:</label>

                <div class="col-md-6">
                    <input id="city" type="city" class="form-control" name="city" value="{{ isset($user->userInfo->city) ? $user->userInfo->city : '' }}">

                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                <label for="state" class="col-md-4 control-label">State:</label>

                <div class="col-md-6">
                    <input id="state" type="state" class="form-control" name="state" value="{{ isset($user->userInfo->state) ? $user->userInfo->state : '' }}">

                    @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                <label for="postcode" class="col-md-4 control-label">Postcode:</label>

                <div class="col-md-6">
                    <input id="postcode" type="postcode" class="form-control" name="postcode" value="{{ isset($user->userInfo->postcode) ? $user->userInfo->postcode : '' }}">

                    @if ($errors->has('postcode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('postcode') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                <label for="country" class="col-md-4 control-label">Country:</label>

                <div class="col-md-6">
                    <input id="country" type="country" class="form-control" name="country" value="{{ isset($user->userInfo->country) ? $user->userInfo->country : '' }}">

                    @if ($errors->has('country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6 col-md-offset-4">
                {{ Form::submit('Save changes', ['class' => 'btn btn-success btn-block']) }}
            </div>

            <!-- Modal Change LOGO -->
            <div id="change-logo" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Change Agency Logo</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::file('logo') }}
                        </div>
                        <div class="modal-footer">
                            {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>

                </div>
            </div>

            {!! Form::close() !!}
        </div>
        <div class="col-md-4">
            <div class="agency-logo">
                <div class="agency-logo-shadow" style="background: url('/upload_images/users/{{isset($user->userInfo->logo) ? $user->userInfo->logo : 'no-logo.png'}}');background-size: cover;">
                    <div class="agency-logo-back">
                        <div class="change-logo-button" role="button" data-toggle="modal" data-target="#change-logo">Change Logo</div>
                    </div>
                </div>
            </div>
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
                    <a property="item" typeof="WebPage" href="{{ route('user.edit') }}">
                        <span property="name">Edit Profile</span>
                    </a>
                    <meta property="position" content="2">
                </li>
            </ol>
        </div>
    </div>
@endsection


