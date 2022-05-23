<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\CustomerEmailVerify;
use App\Models\CustomerLogin;
use App\Models\CustomerPassReset;
use App\Models\Order;
use App\Models\OrderedProductDetails;
use App\Notifications\passResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use  Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;
use Stripe\Customer;

class AccountController extends Controller
{
    function account(){
        $orders=Order::where('user_id',Auth::guard('customerlogin')->id())->get();
       return view('frontend.account',[
           'orders'=>$orders,
       ]);
    }
    function Customerlogout(Request $request){
        Auth::guard('customerlogin')->logout();
        return view('frontend.customer_register');
    }
    function invoice($order_id){

        $orders=Order::where('id',$order_id)->get();
        $bill_details=BillingDetails::where('order_id',$order_id)->get();
        $prod_details=OrderedProductDetails::where('order_id',$order_id)->get();

        $data = [
        'orders'=>$orders,
        'bill_details'=>$bill_details,
        'prod_details'=>$prod_details,
        ];

        $pdf = PDF::loadView('frontend.invoice', $data);

        return $pdf->stream('Invoice.pdf');
    }
    //customer pasword reset
    function customer_password_reset_req(){
        return view('frontend.customer_password_reset_req');
    }
   function customer_password_reset_store(Request $request){
       $customer=CustomerLogin::where('email',$request->email)->firstOrFail();
       $password_reset=CustomerPassReset::where('customer_id',$customer->id)->delete();

      $password_reset = CustomerPassReset::create([
           'customer_id'=>$customer->id,
           'token'=>uniqid(),
           'created_at'=>Carbon::now(),
       ]);
       Notification::send($customer, new passResetNotification($password_reset));
       return back()->with('session',"A Verification link has been sent to ".$request->email);

   }

   function customer_password_reset_form($token){
       return view('password_reset',compact('token'));
   }
   function customer_password_update(Request $request){
       $password_reset =CustomerPassReset::where('token',$request->tokenn)->firstOrFail();
       $customer = CustomerLogin::where('id',$password_reset->customer_id)->firstOrFail();


       $customer->update([
           'password'=>Hash::make($request->password),
       ]);
       CustomerPassReset::where('token',$request->tokenn)->delete();
       return back()->with('session',' Your password been changed Succesfully');
    }
    function email_verify($token){
        $token_verify=CustomerEmailVerify::where('token',$token)->firstOrFail();
        $customer=CustomerLogin::where('id',$token_verify->customer_id)->firstOrFail();

        $customer->update([
            'email_verified_at'=>Carbon::now(),
        ]);
        CustomerEmailVerify::where('token',$token)->delete();
        return view('frontend.customer_register');
    }

}
