<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function index()
    {
        $role_agency = Role::where('name', 'Agency')->first();
        $users = User::where('role_id', $role_agency->id)->get();
        return view('admin.user.index')->withUsers($users);
    }
}
