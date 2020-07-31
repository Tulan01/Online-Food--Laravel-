<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Cart;
Use Session;
session_start();
use Illuminate\Support\facades\Redirect;
class CartController extends Controller
{
    public function addcart (Request $request){
      $user_id=0;
     if(Auth::user()){
      $user_id=1;
     }
      $data=DB::table('menu_items')
          ->where('id',$request->id)
          ->first();
       $contents=Cart::getContent();
       $count=0;


      foreach ($contents as $key) {
      	if($key->id==$request->id){
            $count=1;
      	}
      }
      $noti=Session::get('noti');
      $noti=$noti+1;
      Session::put('noti',$noti);
     $value=array();
     $value['id']=$data->id;
     $value['name']=$data->item_name;
     $value['quantity']=1;
     $value['price']=$data->item_price;
     $value['weight']=0;
     $value['attributes']['image']=$data->item_image;
        //Cart::clear();
      Cart::add($value);

       if($user_id==1){
       $cartitem=DB::table('carts')->where('user_id',Auth::user()->id)->get();
       foreach ($cartitem as $key) {
         if($key->cart_id==$request->id){
              $user_id=2;
         }
       }
        if($user_id==2){
         DB::table('carts')->where('cart_id',$request->id)
                            ->increment('cart_quantity',1);
         }else{
        $cart=array();
        $cart['cart_id']=$data->id;
        $cart['cart_name']=$data->item_name;
        $cart['cart_price']=$data->item_price;
        $cart['cart_quantity']=1;
        $cart['cart_weight']=0;
        $cart['cart_image']=$data->item_image;;
        $cart['user_id']=Auth::user()->id;
        DB::table('carts')->insert($cart);
         }
      }
     
    if($count==1){
    	$data1=Cart::get($request->id);
    	 $value1=array();
         $value1['id']=$data1->id;
	     $value1['name']=$data1->name;
	     $value1['quantity']=$data1->quantity;
	     $value1['price']=$data1->price;
	     $value1['weight']=0;
       $value1['attributes']['image']=$data1->attributes->image;
	     $value1['noti']=$noti;
       
       $value1['total']=Cart::getSubTotal();
	   //  $value1['total_qty']=Cart::getTotalQuantity();   
    	return response()->json($value1);
    }
    else{
      $value['duplecate']='new';
      $value['total']=Cart::getSubTotal();
      $value['noti']=$noti;
       return response()->json($value);
    }
    }

    public function deletecart(Request $request){
        $user_id=0;
         if(Auth::user()){
          $user_id=1;
         }
          session::put('noti',0);
    	 Cart::remove($request->id);
    	  $value=array();
    	  $value['id']=$request->id;
        $value['total']=Cart::getSubTotal();
    	  $value['noti']=null;

        if($user_id==1){
          DB::table('carts')->where('cart_id',$request->id)->delete();
        }
         return response()->json($value);
        
        }

    public function decreasecart(Request $request){

    	Cart::update($request->id, array(
           'quantity' => -1, 
           ));
    	  	 $data1=Cart::get($request->id);
	    	 $value1=array();
	         $value1['id']=$data1->id;
		     $value1['name']=$data1->name;
		     $value1['quantity']=$data1->quantity;
		     $value1['price']=$data1->price;
		     $value1['weight']=0;
		     $value1['attributes']['image']=$data1->attributes->image;
		     $value1['total']=Cart::getSubTotal();
         $user_id=0;
           if(Auth::user()){
            $user_id=1;
           }

           if($user_id==1){
             DB::table('carts')->where('cart_id',$request->id)
                                  ->update(['cart_quantity'=>$data1->quantity]);
           }
         return response()->json($value1);
       }
    
        public function increasecart(Request $request){
       
    	Cart::update($request->id, array(
           'quantity' => 1, 
           ));
    	  	 $data1=Cart::get($request->id);
	    	 $value1=array();
	         $value1['id']=$data1->id;
		     $value1['name']=$data1->name;
		     $value1['quantity']=$data1->quantity;
		     $value1['price']=$data1->price;
		     $value1['weight']=0;
		     $value1['attributes']['image']=$data1->attributes->image;
		     $value1['total']=Cart::getSubTotal();
           $user_id=0;
           if(Auth::user()){
            $user_id=1;
           }

           if($user_id==1){
             DB::table('carts')->where('cart_id',$request->id)
                                  ->update(['cart_quantity'=>$data1->quantity]);
           }
          return response()->json($value1);
    }

    
}
