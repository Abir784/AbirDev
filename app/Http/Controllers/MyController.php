<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Stripe\Product;

class MyController extends Controller
{
    public function welcome()
    {
        $categories=Category::all();
        $product=Products::take(6)->orderBy('id','ASC')->get();
        $latest_products=Products::latest()->take(4)->orderBy('id','DESC')->get();
        $inventories=Inventory::all();
        return view('frontend.frontend',[
            'product'=>$product,
            'categories'=>$categories,
            'inventories'=>$inventories,
            'latest_products'=>$latest_products,
        ]);
    }

    public function dashboard(){
        return view('layouts.dashboard');
    }

    function product_details($product_id){

        $product_info=Products::find($product_id);
        $related_products=Products::where('category_id',$product_info->category_id)->where('id','!=',$product_id)->get();
        $available_colors=Inventory::where('product_id',$product_id)->groupBy('color_id')->selectRaw('sum(color_id) as sum,color_id')->get();
        return view('frontend.product_details',[
            'product_info'=>$product_info,
            'available_colors'=>$available_colors,
            'related_products'=>$related_products,

        ]);

    }
    function getSize(Request $request){
        $available_sizes=Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        $str_to_send='<option  value="Data-display">-Please Select-</option>';

        foreach($available_sizes as $sizes){
            $str_to_send.='<option  value="'.$sizes->id.'">'.$sizes->rel_size->name.'</option>';

        };
        echo $str_to_send;

    }
    function compare_products(Request $request){
        $request->validate([
            'product_1'=>'required',
            'product_2'=>'required',
        ]);

        $prod1=Products::find($request->product_1);
        $prod2=Products::find($request->product_2);

       return view('frontend.compare_products',[
           'prod1'=>$prod1,
           'prod2'=>$prod2,
       ]);

    }


}
