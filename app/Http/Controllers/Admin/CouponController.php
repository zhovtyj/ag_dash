<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\CouponGenerated;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->get();
        $role_agency = Role::where('name', 'Agency')->first();
        $users = User::where('role_id', $role_agency->id)->orderBy('id', 'desc')->get();

        return view('admin.coupon.index')->withCoupons($coupons)->withUsers($users);
    }

    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->user_id = $request->user_id;
        $coupon->code = uniqid();
        $coupon->discount = $request->discount;
        $coupon->expired_in = $request->expired_in;
        $coupon->save();

        $user = User::find($request->user_id);
        Mail::to($user->email)->send(new CouponGenerated($coupon));

        return redirect()->route('coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
