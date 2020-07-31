<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
Use Session;
use DB;
use Cart;
use Auth;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   

    public function showloginform (){
    	return view ('backend.pages.adminlogin');
    }   

 

  public function dologin (Request $request){
  	   // validation 

	  	  $this->validate($request,[
	            'email'=>'required|email',
	            'password'=> 'required|min:6',
	  	  ]);
	      //attempt to log in
	      if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remenber))
	      {
	       return redirect()->intended(route('admin'));
	      } 
	      else{
	      	return redirect()->back()->withInput($request->only('email','remenber'));
	      }
  }


    public function adminlogout(Request $request)
    {
        //$this->guard()->logout();

        //$store= session::get('4yTlTDKu3oJOfzD_cart_items');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //Session::put('4yTlTDKu3oJOfzD_cart_items',$store);

        return redirect()->route('adminlogin');
    }
}
