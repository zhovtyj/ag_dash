@extends('agency.main')

@section('title', $client->business_name)

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
                    <a property="item" typeof="WebPage" href="{{ route('client.index') }}">
                        <span property="name">All Clients</span>
                    </a>
                    <meta property="position" content="2">
                </li>
                <span> › </span>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('client.show', $client->id) }}">
                        <span property="name">{{$client->business_name}}</span>
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
                Client - {{$client->business_name}}
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="client-block col-lg-12">
                        <h2><span class="glyphicon glyphicon-file"></span> Business Information</h2>
                        <div class="col-md-12">
                            <h4>Business Name:</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->business_name }}</strong>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4>Address:</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->address1 }}</strong><br>
                            <strong>{{ $client->address2 }}</strong>
                            <hr>
                        </div>


                        <div class="col-md-12">
                            <h4>City:</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->city }}</strong>
                            <hr>
                        </div>


                        <div class="col-md-12">
                            <h4>State / Province:</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->state }}</strong>
                            <hr>
                        </div>


                        <div class="col-md-12">
                            <h4>Postal Code:</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->postcode }}</strong>
                            <hr>
                        </div>


                        <div class="col-md-12">
                            <h4>Country :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->country }}</strong>
                            <hr>
                        </div>

                    </div>
                </div>

                <div class="col-md-4" style="margin-top:25px">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-user"> </span> Client Info
                        </div>
                        <div class="panel-body">
                            <h5><span class="glyphicon glyphicon-pencil"> </span> <strong>Created at:</strong></h5>
                            <div>{!! $client->created_at !!}</div>
                            <hr>
                            <h5><span class="glyphicon glyphicon-edit"> </span> <strong>Updated at:</strong></h5>
                            <div>{!! $client->updated_at !!}</div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn btn-success btn-block" href="{{route('agency.service.index', $client->id)}}" title="Order New Service">
                                        <span class="glyphicon glyphicon-plus" style="color:#fff"></span>
                                        New Service
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-success btn-block" href="{{route('order.orders', $client->id)}}" title="See all projects">
                                        <span class="glyphicon glyphicon-th-list" style="color:#fff"></span>
                                        All projects
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix" style="margin-top:10px;"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::open(['route' => ['client.destroy', $client->id], 'method' =>'DELETE']) }}
                                        <button type="submit" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"> </span> Delete</button>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-md-offset">
                                    <a href="{{ route('client.index') }}" class="btn btn-default btn-block"><span class="glyphicon glyphicon-arrow-left"></span> Back to all clients</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="row">
                <div class="col-md-8">

                    <div class="client-block col-lg-12">
                        <h2><span class="glyphicon glyphicon-user"></span>Business Contact Information</h2>

                        <div class="col-md-12">
                            <h4>Business Owner's Name :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->business_owners_name }}</strong>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4>Business Owner's Email :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->business_owners_email }}</strong>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4>Business Owner's Phone :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->business_owners_phone }}</strong>
                        </div>
                        <hr>

                        <div class="col-md-12">
                            <h4>Business Fax :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->business_owners_fax }}</strong>
                            <hr>
                        </div>


                        <div class="col-md-12">
                            <h4>Additional Phone Numbers :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->business_owners_phone1 }}</strong>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4>Business Website :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->business_website }}</strong>
                            <hr>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="client-block col-lg-12">
                        <h2><span class="glyphicon glyphicon-book"></span> Additional Business Information</h2>
                        <div class="col-md-12">
                            <h4>Years in Business :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->years_in_business }}</strong>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4>Years in Business :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->years_in_business }}</strong>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4>Business License :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->business_license }}</strong>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4>Payment Types Accepted :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->payment_types_accepted }}</strong>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4>Products or Brands Offered :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->products_or_brands_offered }}</strong>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4>Business Description :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->business_description }}</strong>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4>Business Hours :</h4>
                        </div>
                        <div class="col-md-12">
                            <strong>{{ $client->business_hours }}</strong>
                            <hr>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




