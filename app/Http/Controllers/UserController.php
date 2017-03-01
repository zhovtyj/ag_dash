<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;
use Image;
use App\User;
use App\UserInfo;

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
                'name'              => 'required|max:255',
                'site'              => 'max:255',
                'phone'             => 'max:255',
                'address1'          => 'max:255',
                'city'              => 'max:255',
                'state'             => 'max:255',
                'postcode'          => 'max:255',
                'country'           => 'max:255',
            ));
        }
        else{
            $this->validate($request, array(
                'name'      => 'required|max:255',
                'email'     => 'required|email|max:255|unique:users',
                'site'              => 'max:255',
                'phone'             => 'max:255',
                'address1'          => 'max:255',
                'city'              => 'max:255',
                'state'             => 'max:255',
                'postcode'          => 'max:255',
                'country'           => 'max:255',
            ));
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        if(isset($user->userInfo)){
            $user->userInfo->site = $request->site;
            $user->userInfo->phone = $request->phone;
            $user->userInfo->address1 = $request->address1;
            $user->userInfo->city = $request->city;
            $user->userInfo->state = $request->state;
            $user->userInfo->postcode = $request->postcode;
            $user->userInfo->country = $request->country;

            //Saving Agency LOGO
            if ($request->hasfile('logo')){
                $image = $request->file('logo');
                $filename = time().'.'.$image->getClientOriginalExtension();
                $location = public_path('upload_images/users/'.$filename);
                $img = Image::make($image);
                $img->resize(256, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($location);
                $user->userInfo->logo = $filename;
            }
            $user->userInfo->save();
        }
        else{
            $userInfo = new UserInfo;
            $userInfo->user()->associate($user);
            $userInfo->site = $request->site;
            $userInfo->phone = $request->phone;
            $userInfo->address1 = $request->address1;
            $userInfo->city = $request->city;
            $userInfo->state = $request->state;
            $userInfo->postcode = $request->postcode;
            $userInfo->country = $request->country;

            //Saving Agency LOGO
            if ($request->hasfile('logo')){
                $image = $request->file('logo');
                $filename = time().'.'.$image->getClientOriginalExtension();
                $location = public_path('upload_images/users/'.$filename);
                $img = Image::make($image);
                $img->resize(256, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($location);
                $userInfo->logo = $filename;
            }
            $userInfo->save();
        }


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
