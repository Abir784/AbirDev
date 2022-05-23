<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\ProductThumbnail;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(){
        $products=Products::all();


        $catagory=Category::all();
        return view('admin.product.index',[
            'catagory'=>$catagory,
            'products'=>$products,
        ]);
    }

    public function ajax(Request $request){



        $send_to_cat='<option>---Sub Category name---</option>';
        $subcategories = Subcategory::where('category_id',$request->category_id)->get();
        foreach($subcategories as $subcategory){
            $send_to_cat.='<option value="'.$subcategory->id.' ">'.$subcategory->subcategory_name .'</option>';

        }
        echo $send_to_cat;


    }

    function insert(Request $request){

   $id= Products::insertGetId([
        'category_id'=>$request->category_id,
        'subcategory_id'=>$request->subcategory_id,
        'product_name'=>$request->product_name,
        'tittle'=>$request->tittle,
        'price'=>$request->price,
        'discount'=>$request->discount,
        'after_discount'=>($request->price - ($request->price*$request->discount/100)),
        'brand'=>$request->brand,
        'desp'=>$request->desp,
        'created_at'=>Carbon::now(),

    ]);

    $product_image = $request->product_image;
    $extension = $product_image->GetClientOriginalExtension();
    $product_image_name = $id.'.'.$extension;
    Image::make($product_image)->resize(300, 200)->save(public_path('uploads/product/product_preview/'.$product_image_name));

    Products::find($id)->update([
        'product_image'=>$product_image_name,
    ]);


        $thumbnail_image =  $request->product_thumbnail_image;
        $loop=1;
        foreach($thumbnail_image as $thubmnails){

         $thumbnails_extension = $thubmnails->GetClientOriginalExtension();
        $thumbnail_image_name=$id.'-'.$loop.'.'.$thumbnails_extension;
        Image::make($thubmnails)->resize(300, 200)->save(public_path('uploads/product/thumbnails/'.$thumbnail_image_name));

        ProductThumbnail::insert([
            'product_id'=>$id,
            'product_thumbnail_image'=>$thumbnail_image_name,
            'created_at'=>Carbon::now(),

        ]);
        $loop++;

    }
return back()->with('session','Product Added sussecfully!');

    }
}
