<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    //GET HOME PAGE
    public function getHome()
    {
        if(!Auth::check()){
            return view('templates.home.home');
        }
    }
    
}
