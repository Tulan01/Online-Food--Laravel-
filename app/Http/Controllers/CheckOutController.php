<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Carbon\Carbon;
use DB;
Use Session;
use URL;
use Auth;
session_start();
class CheckOutController extends Controller
{


 public function __construct()
    {

    	$value=explode('/',URL::full());
    	$data=end($value);
    	//dd($value);
    	Session::put('url.intended',$data); 
        $this->middleware('auth');
    }


    public function checkout (){
         $contents=Cart::getContent();
      $value=Cart::getSubTotal();
    	return view ('frontend.pages.checkout',compact('contents','value'));
    }
    public function savecheckout (Request $request){
        session::put('noti',0);
        $cart=Cart::getContent();

        $count=0;
        foreach ($cart as $key) {
        $count=1;
        }
       // return response()->json($cart);
        if($count==1){
         //order table
            $data=array();
            $data['user_id']=Auth::user()->id;
            $data['total_amount']=Cart::getSubTotal();
            $data['order_status']='Active';
            $data['order_date']=Carbon::today()->toDateString();
            $data['created_at']=Carbon::now();
            $data['updated_at']=now();
            $order_id=DB::table('orders')->insertGetId($data);
          //order details

           $detailsdata=array();

           foreach ($cart as $cart) {
            $detailsdata['order_id']=$order_id;
            $detailsdata['item_id']=$cart->id;
            $detailsdata['item_amount']=$cart->price*$cart->quantity;
            $detailsdata['item_quantity']=$cart->quantity;
            $detailsdata['created_at']=Carbon::now();
            $detailsdata['updated_at']=now();
          

            $details_id=DB::table('order_details')->insert($detailsdata);
           } 
            //address insert
            $address=array();
            $address['order_id']=$order_id; 
            $address['user_id']=Auth::user()->id;
            $address['add']=$request->add; 
            $address['add2']=$request->add2; 
            $address['city']=$request->city; 
            $address['country']=$request->country; 
            $address['post_code']=$request->post_code; 
            $address['created_at']=Carbon::now();
            $address['updated_at']=now();
          
            $address=DB::table('delivery_addressses')->insert($address);

            //payment
             $pay=array();
             $pay['order_id']=$order_id;
             $pay['user_id']=Auth::user()->id;
             $pay['pay_method']=$request->payment;
             $pay['pay_status']='Pending';
             $pay['created_at']=Carbon::now();
             $pay['updated_at']=now();

             $pay=DB::table('payments')->insert($pay);
             Cart::clear();
             DB::table('carts')->where('user_id',Auth::user()->id)->delete();

            return redirect()->route('reserve');
           }
         else{
            $notification = array(
                'message' => 'No Item On cart !',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
         }
    }

       public function reserve (){
        $user_id=Auth::user()->id;
        $address=DB::table('delivery_addressses')->where('user_id',$user_id)->first();
        $order=DB::table('orders')->where('user_id',$user_id)->get();
        //return response()->json($order);
        $details=DB::table('orders')
                      ->join('order_details','orders.id','order_details.order_id')
                      ->join('menu_items','order_details.item_id','menu_items.id')
                      ->select('orders.*','order_details.order_id','order_details.item_id','order_details.item_quantity','order_details.item_amount','menu_items.item_name','menu_items.item_image','menu_items.item_price')
                      ->where('user_id',$user_id)->get();
          
      return view('frontend.pages.reservation',compact('address','details','order'));
    }


      public function cancelorder (Request $request){
            $data=DB::table('orders')->where('id',$request->order_id)->update(['order_status'=>'Cancelled']);

            return redirect()->route('reserve');
      }
    
}
