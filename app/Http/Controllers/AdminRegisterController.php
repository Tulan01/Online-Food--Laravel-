<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Session;
use DB;
use Cart;
use Auth;
class AdminRegisterController extends Controller
{
   
     public function __construct()
    {
          $this->middleware('auth:admin');
     }

    public function showadminform (){
    	return view ('backend.pages.adminregister');
    } 

  



    public function adminregister(Request $request)
    {
       $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

       
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

         $data=array();
         $data['name']=$request->name;
         $data['email']=$request->email;
         $data['password']= Hash::make($request->password);
         $data['image']=$image_url;
         $data1=DB::table('admins')->insertGetId($data);

         return redirect()->route('admin');
    }
}
