<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('active', '=', '1')->get();
        return view('agency.service.index')->withServices($services);
    }
}
