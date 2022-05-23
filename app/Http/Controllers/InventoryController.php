<?php

namespace App\Http\Controllers;

use App\Models\color;
use App\Models\Inventory;
use App\Models\Products;
use App\Models\ProductThumbnail;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function index($product_id){
        $inventories=Inventory::where('product_id',$product_id)->get();
        $products=Products::find($product_id);
        $sizes=Size::all();
        $colors=color::all();
        return view('admin.inventory.index',[
            'products'=>$products,
            'sizes'=>$sizes,
            'colors'=>$colors,
            'inventories'=>$inventories,
        ]);
    }

    function color(){
        $colors=color::all();
        return view('admin.inventory.add_color',[
         'colors'=>$colors,
    ]);
    }

    function add_color(Request $request){
        color::insert([
            'name'=>$request->color_name,
            'created_at'=>Carbon::now(),
        ]);

        return back();
    }

    function size(){
        $sizes=Size::all();
        return view('admin.inventory.add_size',[
           'sizes'=>$sizes,
        ]);

    }

    function add_size(Request $request){
        Size::insert([
            'name'=>$request->size,
            'created_at'=>Carbon::now(),
        ]);
        return back();

    }
    function inventory(Request $request){

        if(Inventory::where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){

            Inventory::where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
        }else{

            Inventory::insert([
                'product_id'=>$request->product_id,
                'quantity'=>$request->quantity,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back();
    }
    function delete($product_id){

        Inventory::where('product_id','=',$product_id)->delete();

        unlink(public_path('uploads/product/product_preview/' .Products::find($product_id)->product_image));

        $products=ProductThumbnail::where('product_id','=',$product_id)->get();


        foreach($products as $thumbnail){

            unlink(public_path('uploads/product/thumbnails/' .$thumbnail->product_thumbnail_image));
            ProductThumbnail::find($thumbnail->id)->delete();


        }
        Products::find($product_id)->delete();


        return back()->with('session','Product Deleted');
    }
    function delete_inventory($inventory_id){
        Inventory::find($inventory_id)->delete();
        return back()->with('session','Inventory Deleted !');

    }

}
