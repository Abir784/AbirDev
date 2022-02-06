<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;

use Illuminate\Http\Request;
use app\models\User;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $num_user=User::all()->count();
        $users=User::where('id','!=',Auth::id())->simplePaginate(5);
        return view('home', compact('users','num_user'));
    }
    public function delete($user_id)
    {



        if(User::find($user_id)->profile_image == '0.PNG'){


            echo '';
        }else{

            unlink(public_path('uploads/profile_image/'.User::find($user_id)->profile_image));


        }

        User::find($user_id)->delete();
        return back();
    }

}
