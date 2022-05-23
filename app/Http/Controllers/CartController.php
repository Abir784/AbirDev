<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    function cart(Request $request){
        $coupon_code=$request->coupon_code;
        $carts=Cart::where('user_id',Auth::guard('customerlogin')->id())->get();
        $message=null;
        if($coupon_code == ''){
            $discount=0;
        }else{
            if(Coupon::where('coupon_code',$coupon_code)->exists()){
                if(Carbon::now()->format('Y-m-d') > Coupon::where('coupon_code',$coupon_code)->first()->validity){
                    $message='Coupon Code Expired';
                    $discount=0;
                }else{
                    $discount=Coupon::where('coupon_code',$coupon_code)->first()->discount;
                }

            }else{
                $message='Invalid Coupon Code';
                $discount=0;

            }
        }
        return view('frontend.cart',[
            'carts'=>$carts,
            'discount'=> $discount,
            'coupon_code'=> $coupon_code,
            'message'=> $message,
        ]);
    }


    function cart_insert(Request $request){
        Cart::insert([
            'user_id'=>Auth::guard('customerlogin')->user()->id,
            'product_id'=>$request->product_id,
            'size_id'=>$request->size_id,
            'color_id'=>$request->color_id,
            'quantity'=>$request->quantity,
            'created_at'=>Carbon::now(),

        ]);
        return back()->with('cart','Cart Added Successfully');
    }
    function cart_delete($cart_id){
        Cart::find($cart_id)->delete();
        return back();

    }

    function cart_update(Request $request){

        foreach ($request->quantity as $cart_id=>$quantity){
            Cart::find($cart_id)->update([
                'quantity'=>$quantity,
            ]);
        }
        return back()->with('cart_update',"Cart Updated Successfully");
    }

}
