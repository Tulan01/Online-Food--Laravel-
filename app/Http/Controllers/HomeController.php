<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $value=explode("/", URL::full());
        $data=end($value);
        Session::put('url.intended',$data); 
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
