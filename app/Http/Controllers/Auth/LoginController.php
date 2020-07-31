<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
Use Session;
use DB;
use Cart;
use Auth;

class LoginController extends Controller
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;

   protected function redirectTo(){
        $data=DB::table('carts')->where('user_id',Auth::user()->id)->get();
           if($data){
                foreach ($data as $data) {
                 $value=array();
                 $value['id']=$data->cart_id;
                 $value['name']=$data->cart_name;
                 $value['quantity']=$data->cart_quantity;
                 $value['price']=$data->cart_price;
                 $value['weight']=0;
                 $value['attributes']['image']=$data->cart_image;
        //Cart::clear();
                Cart::add($value);
            }
        }

        $data=Session::get('url.intended');
        if($data){
          return '$data';
        }
        else{
          return '/';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
