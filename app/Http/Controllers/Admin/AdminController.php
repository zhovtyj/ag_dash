<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\User;
use App\Client;
use App\Service;


class AdminController extends Controller
{
    public function index()
    {
        $count['service'] = Service::count();
        $count['user'] = User::where('role_id', '<>', '1')->count();
        $count['client'] = Client::count();
        return view('admin.dashboard.index')->withCount($count);



    }
}
