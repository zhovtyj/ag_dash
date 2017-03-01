<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\User;
use App\Client;


class ClientController extends Controller
{
    public function index($agency_id)
    {
        //$clients = Client::where('agency_id', $agency_id)->get();
        //return view('admin.client.index')->withClients($clients);
        $user = User::find($agency_id);
        return view('admin.client.index')->withUser($user);
    }

    public function create($agency_id)
    {
        $user = User::find($agency_id);
        return view('admin.client.create')->withUser($user);
    }

    public function store(Request $request, $agency_id)
    {
        $client = new Client;
        $user = User::find($agency_id);

        $client->user()->associate($user);
        $client->business_name = $request->business_name;
        $client->address1 = $request->address1;
        $client->address2 = $request->address2;
        $client->city = $request->city;
        $client->state = $request->state;
        $client->postcode = $request->postcode;
        $client->country = $request->country;
        $client->business_owners_name = $request->business_owners_name;
        $client->business_owners_email = $request->business_owners_email;
        $client->business_owners_phone = $request->business_owners_phone;
        $client->business_owners_fax = $request->business_owners_fax;
        $client->business_owners_phone = $request->business_owners_phone;
        $client->business_website = $request->business_website;
        $client->years_in_business = $request->years_in_business;
        $client->business_license = $request->business_license;
        $client->payment_types_accepted = $request->payment_types_accepted;
        $client->products_or_brands_offered = $request->products_or_brands_offered;
        $client->business_description = $request->business_description ;
        $client->business_hours = $request->business_hours;

        $client->save();

        Session::flash('success', 'Client created successfully!');

        return redirect()->route('admin.client.show', [$user->id, $client->id]);
    }

    public function show($agency_id, $client_id)
    {
        $user = User::find($agency_id);
        $client = Client::find($client_id);
        return view('admin.client.show')->withUser($user)->withClient($client);
    }

    public function edit($agency_id, $client_id)
    {
        $user = User::find($agency_id);
        $client = Client::find($client_id);
        return view('admin.client.edit')->withUser($user)->withClient($client);
    }

    public function update(Request $request, $agency_id, $client_id)
    {
        $user = User::find($agency_id);
        $client = Client::find($client_id);

        $client->business_name = $request->business_name;
        $client->address1 = $request->address1;
        $client->address2 = $request->address2;
        $client->city = $request->city;
        $client->state = $request->state;
        $client->postcode = $request->postcode;
        $client->country = $request->country;
        $client->business_owners_name = $request->business_owners_name;
        $client->business_owners_email = $request->business_owners_email;
        $client->business_owners_phone = $request->business_owners_phone;
        $client->business_owners_fax = $request->business_owners_fax;
        $client->business_owners_phone = $request->business_owners_phone;
        $client->business_website = $request->business_website;
        $client->years_in_business = $request->years_in_business;
        $client->business_license = $request->business_license;
        $client->payment_types_accepted = $request->payment_types_accepted;
        $client->products_or_brands_offered = $request->products_or_brands_offered;
        $client->business_description = $request->business_description ;
        $client->business_hours = $request->business_hours;

        $client->save();

        Session::flash('success', 'Client updated successfully!');

        return redirect()->route('admin.client.show', [$user->id, $client->id]);
    }

    public function destroy($agency_id, $client_id)
    {
        $client = Client::find($client_id);
        //$client->cart()->cartserviceoptionals()->delete();
        $client->cart()->delete();
        $client->delete();
        Session::flash('success', 'Client was deleted!');

        return redirect()->route('admin.client', $agency_id);
    }

}
