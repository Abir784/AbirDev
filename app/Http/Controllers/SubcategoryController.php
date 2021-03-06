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
    function delete($subcategory_id){
        Subcategory::find($subcategory_id)->delete();
        return back()->with('deleted', 'Subcategory Trashed Succesfully !');


    }
    function edit($subcategory_id){
        $cat_info=Category::where('id','!=',Subcategory::find($subcategory_id)->category_id)->get();
        $sub_info=Subcategory::find($subcategory_id);
        return view('admin.sub_category.edit',[
            'sub_info'=>$sub_info,
            'cat_info'=>$cat_info,
        ]);
    }

    function update(Request $request){
        Subcategory::find($request->id)->update([
            'subcategory_name'=>$request->subcategory_name,
            'category_id'=>$request->category_id,
            'updated_at'=>Carbon::now(),
        ]);


        return back()->with('updated', 'Sub Category Updated Succesfully !');


    }



}
