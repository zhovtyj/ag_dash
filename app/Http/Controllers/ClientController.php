<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Client;
use App\User;

class ClientController extends Controller
{

    public function index()
    {
        $user = User::find(Auth::user()->id);
        $clients = Client::where('user_id', '=', $user->id)->get();
        return view('agency.client.index')->withClients($clients);
    }

    public function create()
    {
        return view('agency.client.create');
    }

    public function store(Request $request)
    {
        $client = new Client;
        $user = User::find(Auth::user()->id);

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
        $client->keywords = $request->keywords;
        $client->logo_url = $request->logo_url;
        $client->photo_url1 = $request->photo_url1;
        $client->photo_url2 = $request->photo_url2;
        $client->photo_url3 = $request->photo_url3;
        $client->photo_url4 = $request->photo_url4;
        $client->photo_url5 = $request->photo_url5;
        $client->video_url = $request->video_url;
        $client->social_accounts = $request->social_accounts;
        $client->citations = $request->citations;
        $client->website_login = $request->website_login;
        $client->notes = $request->notes;

        $client->save();

        Session::flash('success', 'Client created successfully!');

        return redirect()->route('client.show', $client->id);
    }

    public function show($id)
    {
        $client = Client::find($id);
        return view('agency.client.show')->withClient($client);
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('agency.client.edit')->withClient($client);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);

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
        $client->keywords = $request->keywords;
        $client->logo_url = $request->logo_url;
        $client->photo_url1 = $request->photo_url1;
        $client->photo_url2 = $request->photo_url2;
        $client->photo_url3 = $request->photo_url3;
        $client->photo_url4 = $request->photo_url4;
        $client->photo_url5 = $request->photo_url5;
        $client->video_url = $request->video_url;
        $client->social_accounts = $request->social_accounts;
        $client->citations = $request->citations;
        $client->website_login = $request->website_login;
        $client->notes = $request->notes;

        $client->save();

        Session::flash('success', 'Client updated successfully!');

        return redirect()->route('client.show', $client->id);
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        //$client->cart()->cartserviceoptionals()->delete();
        $client->cart()->delete();
        $client->delete();
        Session::flash('success', 'Client was deleted!');

        return redirect()->route('client.index');
    }
}
