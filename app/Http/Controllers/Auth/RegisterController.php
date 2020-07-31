<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Session;
use DB;
use Cart;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
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
        return '/';
    
        }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   

        $request = request();
        $image = $request->file('image');
        if($image){
        $image_name=hexdec(uniqid());
        $ext=strtolower($image->getClientOriginalExtension());
        $image_full_name=$image_name.'.'.$ext; 
        $upload_path='images/Profile/';
        $image_url=$upload_path.$image_full_name; 
        $success=$image->move($upload_path,$image_full_name);
        }else{
             $image_url="images/Profile/default.jpg";
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'image' =>  $image_url,
            'password' => Hash::make($data['password']),
        ]);
    }
}
