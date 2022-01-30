<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    function subcategory(){

        $subcategory= Subcategory::all();
       $category = Category::all();
        return view('admin/sub_category/index',[
           'category'=> $category,
           'subcategory' => $subcategory,

        ]);
    }

    function insert(SubcategoryRequest $request){
        Subcategory::insert([
            'subcategory_name'=>$request->subcategory_name,
            'category_id'=>$request->category_id,
            'created_at'=>Carbon::now(),

        ]);
        return back()->with('sub_added','Sub category Added Successfully !');
    }

}
