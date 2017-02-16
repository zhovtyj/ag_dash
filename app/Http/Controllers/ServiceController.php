<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Client;

class ServiceController extends Controller
{
    public function index($client_id)
    {
        $client = Client::find($client_id);
        $services = Service::orderBy('id', 'desc')->paginate(100);
        return view('agency.service.index')->withServices($services)->withClient($client);
    }

    public function show($id)
    {
        $service = Service::find($id);
        return view('agency.service.show')->withService($service);
    }
}
