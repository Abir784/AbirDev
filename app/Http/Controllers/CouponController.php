<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    function coupon(){
        $coupon=Coupon::all();

        return view('admin.coupon.index',[
           'coupon'=>$coupon,
        ]);
    }
    function coupon_insert(Request $request){
        Coupon::insert([
            'coupon_code'=>$request->coupon_code,
            'discount'=>$request->discount,
            'validity'=>$request->validity,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }

}
