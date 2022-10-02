<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    function addcoupon(){
        return view('admin\coupon\index',[
            'coupons' => Coupon::all()
        ]);

    }
    function addcouponpost(Request $request){
        $request->validate([
            'coupon_name' => 'required|unique:coupons,coupon_name',
            'discount_amount' => 'required|numeric|min:1|max:99',
            'validaty_till' => 'required'
        ]);
        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'discount_amount' => $request->discount_amount,
            'validaty_till' => $request->validaty_till,
            'created_at' => Carbon::now()
         ]);
         return back();
     }
}
