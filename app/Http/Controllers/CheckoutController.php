<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\BillingDetails;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderedProductDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class CheckoutController extends Controller
{

    function checkout(){
        $carts=Cart::where('user_id',Auth::guard('customerlogin')->id())->get();
        $total=0;
        $countries=Country::all();
        foreach($carts as $cart){
            $total+=$cart->rel_to_products->after_discount*$cart->quantity;
        }
        return view('frontend.checkout',[
            'total'=>$total,
            'countries'=>$countries,
        ]);
    }
    function get_cities(Request $request){
        $cities= City::where('country_id',$request->country_id)->get();
        $str_to_city='<option> Select a City...</option>';

        foreach($cities as $city){
            $str_to_city.='<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str_to_city;



    }

    function order_insert(Request $request){
        //order details
     if($request->delivery_method =='1'){
        $order_id =  Order::insertGetId([
            'user_id'=>$request->user_id,
            'discount'=>$request->discount,
            'delivery_charge'=>$request->delivery_location,
            'total'=>($request->total-$request->discount)+$request->delivery_location,
            'delivery_method'=>$request->delivery_method,
            'created_at'=>Carbon::now(),


        ]);
        //billing details
        BillingDetails::insert([
            'order_id'=>$order_id,
            'user_id'=>$request->user_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'company'=>$request->company,
            'phone'=>$request->phone,
            'country_id'=>$request->country_id,
            'city_id'=>$request->city_id,
            'address'=>$request->address,
            'notes'=>$request->notes,
            'created_at'=>Carbon::now(),
        ]);
        //product details insert

        $carts=Cart::where('user_id',$request->user_id)->get();

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

           Mail::to($request->email)->send(new InvoiceMail($order_id));
           $url = "http://66.45.237.70/api.php";
           $number=$request->phone;
           $text="Thank You ordering , You order number is".$order_id."your total bill is :".($request->total-$request->discount)+$request->delivery_location." Taka";
           $data= array(
           'username'=>"Abirdev",
           'password'=>"PC9RHVZE",
           'number'=>"$number",
           'message'=>"$text"
           );
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);
            $p = explode("|",$smsresult);
            $sendstatus = $p[0];


            Cart::where('user_id',$request->user_id)->delete();
            return view('frontend.order_success')->with('session','Order Placed');


        }else if($request->delivery_method =='2'){
            $data=$request->all();
            return view('exampleHosted',[
             'data'=>$data,
            ]);



        }else if($request->delivery_method =='3'){
            $data=$request->all();
            return view('stripe',[
             'data'=>$data,
            ]);
        }




    }
    function order_success(){
        return view('frontend.order_success');

    }


}
