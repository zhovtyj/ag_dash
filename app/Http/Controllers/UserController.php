<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;
use App\User;

class UserController extends Controller
{
    public function edit()
    {
        $user = User::find(Auth::user()->id);
        return view('agency.user.edit')->withUser($user);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if($user->email == $request->email){
            $this->validate($request, array(
                'name'      => 'required|max:255',
            ));
        }
        else{
            $this->validate($request, array(
                'name'      => 'required|max:255',
                'email'     => 'required|email|max:255|unique:users',
            ));
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Session::flash('success', 'Information updated successfully!');

        return redirect()->route('user.edit');
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, array(
            'old_password'              => 'required|max:255',
            'password'                  => 'required|min:6|max:255',
            'password_confirmation'     => 'required|same:password',
        ));

        $user = User::find(Auth::user()->id);

        if(Hash::check($request->old_password, $user->password)){
        $user->password = bcrypt($request->password);
        $user->save();

        Session::flash('success', 'Password changed successfully!');

        }
        else{

            Session::flash('error', 'Enter correct password!');

            $errors = ['old_password'=>'Enter correct password!'];
        }

        return redirect()->route('user.edit');
    }

}
