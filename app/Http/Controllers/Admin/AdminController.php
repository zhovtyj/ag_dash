<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Service;

class AdminController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.dashboard.index')->withServices($services);
    }
}
