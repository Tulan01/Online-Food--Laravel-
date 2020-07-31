<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Carbon\Carbon;
use Session;
class DisplayController extends Controller
{
   public function index (){
   	$catagory=DB::table('catagories')->where('catagory_status','Active')->get();
   	$item=DB::table('menu_items')
   	           ->join('catagories','menu_items.catagory_id','catagories.id')
   	           ->select('menu_items.*','catagories.catagory_name')
   	           ->where('menu_items.item_status','Active')
   	           ->get();
            session::put('active',1);

   	 return view ('frontend.pages.index',compact('catagory','item'));
   }

   public function menu () {
        $catagory=DB::table('catagories')
                  ->where('catagory_status','Active')
                  ->get();
              session::put('active',2);
   	  return view ('frontend.pages.menu',compact('catagory'));
   }

  
   public function order () {
      $catagory=DB::table('catagories')->where('catagory_status','Active')->get();
        $item=DB::table('menu_items')
               ->join('catagories','menu_items.catagory_id','catagories.id')
               ->select('menu_items.*','catagories.catagory_name')
               ->where('menu_items.item_status','Active')
               ->get();
              session::put('active',3);
   	  return view ('frontend.pages.order',compact('catagory','item'));
   }

   
   
    public function showcart (){
       session::put('noti',0);
      $contents=Cart::getContent();
      $value=Cart::getSubTotal();
            session::put('active',5);
   	  return view ('frontend.pages.cart',compact('contents','value'));
   }
   
    public function find (){
       $dayOfTheWeek = Carbon::today();

       return response()->json($dayOfTheWeek);
     }

 
   

}
