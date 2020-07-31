<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use Session;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


   public function __construct()
    {  
        $this->middleware('auth:admin');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        return view('backend.pages.adminpage');
    }

   public function adminhome()
    {
        return view('admin');
    }

    
}