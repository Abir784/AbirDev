<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\Cart;
use App\Models\Order;
use App\Models\BillingDetails;
use App\Models\OrderedProductDetails;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Inventory;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->total * 100,
                "currency" => "BDT",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        $data=session('data');

        $order_id =  Order::insertGetId([
            'user_id'=>Auth::guard('customerlogin')->id(),
            'discount'=>$data['discount'],
            'delivery_charge'=>$data['delivery_location'],
            'total'=>($data['total']-$data['discount'])+$data['delivery_location'],
            'delivery_method'=>$data['delivery_method'],
            'created_at'=>Carbon::now(),


        ]);
        //billing details
        BillingDetails::insert([
            'order_id'=>$order_id,
            'user_id'=>Auth::guard('customerlogin')->id(),
            'name'=>$data['name'],
            'email'=>$data['email'],
            'company'=>$data['company'],
            'phone'=>$data['phone'],
            'country_id'=>$data['country_id'],
            'city_id'=>$data['city_id'],
            'address'=>$data['address'],
            'notes'=>$data['notes'],
            'created_at'=>Carbon::now(),
        ]);
        //product details insert

        $carts=Cart::where('user_id',Auth::guard('customerlogin')->id())->get();

        foreach($carts as $cart){
            OrderedProductDetails::insert([
                'order_id'=>$order_id,
                'product_id'=>$cart->product_id,
                'product_price'=>$cart->rel_to_products->after_discount,
                'color_id'=>$cart->color_id,
                'size_id'=>$cart->size_id,
                'quantity'=>$cart->quantity,
                'created_at'=>Carbon::now(),
            ]);
                Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('quantity', $cart->quantity);
        }

        Mail::to($data['email'])->send(new InvoiceMail($order_id));


        Cart::where('user_id',Auth::guard('customerlogin')->id())->delete();

        return Redirect('/order/success')->with('order_success','Your Order Has been Placed Succesfully');    }
}
