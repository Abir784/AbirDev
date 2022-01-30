<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{
    function category(){
        $cat=Category::all();
        $soft=Category::onlyTrashed()->get();
        return view('admin/category/index',[
            'cat'=>$cat,
            'soft'=>$soft,
    ]);

    }
    function insert(CategoryRequest $request){


        $Category_insert_id= Category::insertGetId([
            'catagory_name'=>$request->catagory_name,

            'added_by'=>Auth::id(),
            'created_at'=>Carbon::now(),
        ]);

        $category_image = $request->category_image;
        $extension=$category_image->getClientOriginalExtension();
        $original_image_name=$Category_insert_id.'.'.$extension;
        Image::make($category_image)->resize(300, 200)->save(public_path('uploads/category/'.$original_image_name));

        Category::find($Category_insert_id)->update([
            'category_image'=>$original_image_name,
        ]);


        return back()->with('success','Category Added succesfully');


    }
    function delete($category_id){

        Category::find($category_id)->delete();
        return back()->with('deleted','Catagory Deleted');


    }
    function restore($category_id){

        Category::onlyTrashed()->find($category_id)->restore();
        return back();


    }
    function force_delete($category_id){

        $file_path=public_path('uploads/category/'.Category::onlyTrashed()->find($category_id)->category_image);

        unlink($file_path);
        Category::onlyTrashed()->find($category_id)->forceDelete();
        return back()->with('force_deleted','Category deleted permanantly');

    }
    function edit($category_id){

       $edit_info=Category::find($category_id);
       return view('admin.category.edit',compact('edit_info'));

    }
   function update(CategoryRequest $request){

    if($request->hasFile('category_image')){
    $query=Category::find($request->id)->category_image;

    unlink(public_path('uploads/category/'.$query));


    $category_image = $request->category_image;
    $extension=$category_image->getClientOriginalExtension();
    $original_image_name=$request->id.'.'.$extension;
    Image::make($category_image)->resize(300, 200)->save(public_path('uploads/category/'.$original_image_name));

    Category::find($request->id)->update([
        'catagory_name'=>$request->catagory_name,
        'category_image'=>$original_image_name,
        'updated_at'=>Carbon::now(),
    ]);

    }else{
    Category::find($request->id)->update([
        'catagory_name'=>$request->catagory_name,
        'updated_at'=>Carbon::now(),
    ]);

    }

    return back()->with('success','succesfully Updated!');
   }
   function markdel(Request $request){

    foreach($request->mark as $mark){

        Category::find($mark)->delete();
    }
    return back();

   }
   function markrestore($category_id){

    Category::onlyTrashed()->restore();
    return back()->with('restore_all','Restored everything');
   }

   function subcategory(){
       return view('admin/sub_category/index');
   }

}


