<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function profile(){
        return view('admin.profile.index');
    }
    function profile_change(ProfileRequest $request){
        if(Hash::check($request->old_password, Auth::user()->password)){

            if ($request->hasFile('profile_image')) {
                if($request->password == ''){
                   //with image and without password
                            if(Auth::user()->profile_image == '0.PNG'){
                                echo '';

                            }else{
                                unlink(public_path('uploads/profile_image/'.Auth::user()->profile_image));
                            }

                        $user_image = $request->profile_image;
                        $extension=$user_image->getClientOriginalExtension();
                        $original_image_name=Auth::id().'.'.$extension;
                        Image::make($user_image)->save(public_path('uploads/profile_image/'.$original_image_name));


                        User::find(Auth::id())->update([

                            'name'=>$request->name,
                            'profile_image'=>$original_image_name,
                        ]);

                        }else{
                        //with photo and with password;
                            $password=bcrypt($request->password);
                            if(Auth::user()->profile_image == '0.PNG'){
                            echo '';

                            }else{
                            unlink(public_path('uploads/profile_image/'.Auth::user()->profile_image));
                            }

                            $user_image = $request->profile_image;
                            $extension=$user_image->getClientOriginalExtension();
                            $original_image_name=Auth::id().'.'.$extension;
                            Image::make($user_image)->save(public_path('uploads/profile_image/'.$original_image_name));


                            User::find(Auth::id())->update([

                                'name'=>$request->name,
                                'profile_image'=>$original_image_name,
                                'password'=>$password,
                            ]);


                }


                        }else{

                            //without photo and password;
                            User::find(Auth::id())->update([

                                'name'=>$request->name,
                            ]);
       }
     }
        else{
            return back()->with('session', 'You  have Entered wrong password');
        }
        return back()->with('session' ,'Your Profile has been Succesfully updated');

    }



}
