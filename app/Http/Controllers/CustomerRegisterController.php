<?php

namespace App\Http\Controllers;

use App\Models\CustomerEmailVerify;
use App\Models\CustomerLogin;
use App\Notifications\CustomerEmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Notification;


class CustomerRegisterController extends Controller
{
    function show_register_form(){
        return view('frontend.customer_register');
    }
    function customer_register(Request $request){
        CustomerLogin::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),

        ]);
        $customer=CustomerLogin::where('email',$request->email)->firstOrFail();
        $email_verify=CustomerEmailVerify::where('customer_id',$customer->id)->delete();

       $email_verify = CustomerEmailVerify::create([
            'customer_id'=>$customer->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);
        Notification::send($customer, new CustomerEmailVerifyNotification($email_verify));
        return back()->with('session',"A Verification link has been sent to ".$request->email);



        return back()->with('register','Registered Succesfully');

    }
}
