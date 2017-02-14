<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Client;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role->name == 'Admin'){
            return redirect()->route('admin.index');
        }

        $clients = Client::all();
        return view('agency.dashboard.index')->withClients($clients);
    }
}
