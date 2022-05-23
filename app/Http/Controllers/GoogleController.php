<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogin;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;




use Illuminate\Http\Request;

class GoogleController extends Controller
{
    function redirectToProvider(){

        return Socialite::driver('google')->redirect();

    }
     function handleProviderCallback(){

        $user = Socialite::driver('google')->user();

        if(CustomerLogin::where('email',$user->getEmail())->exists()){
            if(Auth::guard('customerlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'defaultgitpass'])){
                return redirect('/');
            }
        }else{
            CustomerLogin::insert([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt('defaultgitpass'),
                'created_at'=>Carbon::now(),
            ]);
            if(Auth::guard('customerlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'defaultgitpass'])){
                return redirect('/');
            }

        }

    }
}
