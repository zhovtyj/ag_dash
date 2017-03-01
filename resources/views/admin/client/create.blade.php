@extends('admin.main')

@section('title', 'All Clients')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Add a New Client
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.client.store', $user->id) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="client-block col-lg-12">
                            <h2><span class="glyphicon glyphicon-file"></span> Business Information</h2>
                            <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                                <label for="business_name" class="col-md-12 control-label">Business Name *</label>

                                <div class="col-md-12">
                                    <input id="business_name" type="text" class="form-control" name="business_name" value="{{ old('business_name') }}" required>

                                    @if ($errors->has('business_name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('business_name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                <label for="address1" class="col-md-12 control-label">Address *</label>

                                <div class="col-md-12">
                                    <input id="address1" type="text" class="form-control" name="address1" value="{{ old('address1') }}" required>

                                    @if ($errors->has('address1'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('address1') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <input id="address2" type="text" class="form-control" name="address2" value="{{ old('address2') }}">

                                    @if ($errors->has('address2'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('address2') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-12 control-label">City *</label>

                                <div class="col-md-12">
                                    <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="state" class="col-md-12 control-label">State / Province*</label>

                                <div class="col-md-12">
                                    <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required>

                                    @if ($errors->has('state'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                                <label for="postcode" class="col-md-12 control-label">Postal Code*</label>
                                <div class="col-md-12">
                                    <input id="postcode" type="text" class="form-control" name="postcode" value="{{ old('postcode') }}" required>

                                    @if ($errors->has('postcode'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('postcode') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                <label for="country" class="col-md-12 control-label">Country *</label>

                                <div class="col-md-12">
                                    <input id="country" type="text" class="form-control" name="country" value="{{ old('country') }}" required>

                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-6">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="client-block col-lg-12">
                            <h2><span class="glyphicon glyphicon-user"></span>Business Contact Information</h2>
                            <div class="form-group{{ $errors->has('business_owners_name') ? ' has-error' : '' }}">
                                <label for="business_owners_name" class="col-md-12 control-label">Business Owner's Name *</label>

                                <div class="col-md-12">
                                    <input id="business_owners_name" type="text" class="form-control" name="business_owners_name" value="{{ old('business_owners_name') }}" required>

                                    @if ($errors->has('business_owners_name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('business_owners_name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('business_owners_email') ? ' has-error' : '' }}">
                                <label for="business_owners_email" class="col-md-12 control-label">Business Owner's Email *</label>

                                <div class="col-md-12">
                                    <input id="business_owners_email" type="text" class="form-control" name="business_owners_email" value="{{ old('business_owners_email') }}" required>

                                    @if ($errors->has('business_owners_email'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('business_owners_email') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('business_owners_phone') ? ' has-error' : '' }}">
                                <label for="business_owners_phone" class="col-md-12 control-label">Business Phone *</label>

                                <div class="col-md-12">
                                    <input id="business_owners_phone" type="text" class="form-control" name="business_owners_phone" value="{{ old('business_owners_phone') }}" required>

                                    @if ($errors->has('business_owners_phone'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('business_owners_phone') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('business_owners_fax') ? ' has-error' : '' }}">
                                <label for="business_owners_fax" class="col-md-12 control-label">Business Fax</label>

                                <div class="col-md-12">
                                    <input id="business_owners_fax" type="text" class="form-control" name="business_owners_fax" value="{{ old('business_owners_fax') }}">

                                    @if ($errors->has('business_owners_fax'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('business_owners_fax') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('business_owners_phone1') ? ' has-error' : '' }}">
                                <label for="business_owners_phone1" class="col-md-12 control-label">Additional Phone Numbers</label>

                                <div class="col-md-12">
                                    <input id="business_owners_phone1" type="text" class="form-control" name="business_owners_phone1" value="{{ old('business_owners_phone1') }}">

                                    @if ($errors->has('business_owners_phone1'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('business_owners_phone1') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('business_website') ? ' has-error' : '' }}">
                                <label for="business_website" class="col-md-12 control-label">Business Website*</label>

                                <div class="col-md-12">
                                    <input id="business_website" type="text" class="form-control" name="business_website" value="{{ old('business_website') }}" required>

                                    @if ($errors->has('business_website'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('business_website') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-6">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="client-block col-lg-12">
                            <h2><span class="glyphicon glyphicon-book"></span> Additional Business Information</h2>
                            <div class="form-group{{ $errors->has('years_in_business') ? ' has-error' : '' }}">
                                <label for="years_in_business" class="col-md-12 control-label">Years in Business</label>

                                <div class="col-md-12">
                                    <input id="years_in_business" type="text" class="form-control" name="years_in_business" value="{{ old('years_in_business') }}" required>

                                    @if ($errors->has('years_in_business'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('years_in_business') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('business_license') ? ' has-error' : '' }}">
                                <label for="business_license" class="col-md-12 control-label">Business License</label>

                                <div class="col-md-12">
                                    <input id="business_license" type="text" class="form-control" name="business_license" value="{{ old('business_license') }}">

                                    @if ($errors->has('business_license'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('business_license') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('payment_types_accepted') ? ' has-error' : '' }}">
                                <label for="payment_types_accepted" class="col-md-12 control-label">Payment Types Accepted</label>

                                <div class="col-md-12">
                                    <input id="payment_types_accepted" type="text" class="form-control" name="payment_types_accepted" value="{{ old('payment_types_accepted') }}">

                                    @if ($errors->has('payment_types_accepted'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('payment_types_accepted') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('products_or_brands_offered') ? ' has-error' : '' }}">
                                <label for="products_or_brands_offered" class="col-md-12 control-label">Products or Brands Offered</label>

                                <div class="col-md-12">
                                    <input id="products_or_brands_offered" type="text" class="form-control" name="products_or_brands_offered" value="{{ old('products_or_brands_offered') }}">

                                    @if ($errors->has('products_or_brands_offered'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('products_or_brands_offered') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('business_description') ? ' has-error' : '' }}">
                                <label for="business_description" class="col-md-12 control-label">Business Description*</label>

                                <div class="col-md-12">
                                    <textarea id="business_description" class="form-control" name="business_description" required>{{ old('business_description') }}</textarea>

                                    @if ($errors->has('business_description'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('business_description') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('business_hours') ? ' has-error' : '' }}">
                                <label for="business_hours" class="col-md-12 control-label">Business Hours*</label>

                                <div class="col-md-12">
                                    <input id="business_hours" type="text" class="form-control" name="business_hours" value="{{ old('business_hours') }}" required>

                                    @if ($errors->has('business_hours'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('business_hours') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-6">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
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
                    <a property="item" typeof="WebPage" href="{{ route('admin.user') }}">
                        <span property="name">All Agency</span>
                    </a>
                    <meta property="position" content="2">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="#">
                        <span property="name">{{$user->name}}</span>
                    </a>
                    <meta property="position" content="3">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('admin.client', $user->id) }}">
                        <span property="name">All Clients</span>
                    </a>
                    <meta property="position" content="4">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('admin.client.create', $user->id) }}">
                        <span property="name">Create New Client</span>
                    </a>
                    <meta property="position" content="5">
                </li>
            </ol>
        </div>
    </div>
@endsection
