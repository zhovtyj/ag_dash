<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->paginate(100);
        return view('agency.service.index')->withServices($services);
    }

    public function show($id)
    {
        $service = Service::find($id);
        return view('agency.service.show')->withService($service);
    }
}
