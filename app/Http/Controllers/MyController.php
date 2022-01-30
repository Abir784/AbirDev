<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }





}
