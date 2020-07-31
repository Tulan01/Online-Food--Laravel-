<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
use Carbon\Carbon; 
use Validator;
class OrderDetailsController extends Controller
{

       public function __construct()
    {  
        $this->middleware('auth:admin');
    }



    public function vieworderdeatails ($id){
        $order_id=$id;
        $user=DB::table('orders')->where('id',$id)->first();
        $item=DB::table('menu_items')->where('item_status',"Active")->get();
        $user_id=$user->user_id;
    	$data=DB::table('order_details')
                       ->join('menu_items','order_details.item_id','menu_items.id')
                       ->select('order_details.*','menu_items.item_name','menu_items.item_price','menu_items.item_image')
    	               ->where('order_id',$id)->get();
    	  return view('backend.pages.orderdetails',compact('data','order_id','user_id','item'));
    }

    
     public function addorderdetails (Request $request){
            // return response()->j son($request->order_id);
         $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'item_id' => 'required',
            'item_quantity' => 'required',
           
        ]);
        
        
        if ($validator->passes()) {
               $data=array();
               $data['order_id']=$request->order_id;
              // $data['user_id']=$request->user_id;
               $data['item_id']=$request->item_id;
               $data['item_quantity']=$request->item_quantity;
               $data['created_at']=Carbon::now();
               $data['updated_at']=now();
          $item=DB::table('menu_items')->where('id',$request->item_id)->first();
               $data['item_amount']=$item->item_price*$request->item_quantity;

              $data1=DB::table('order_details')->insertGetId($data);

               $add=DB::table('order_details')->where('order_id',$request->order_id)->get();
              	$amount=0;
              	foreach ($add as $key) {
              		$amount=$amount+$key->item_amount;
              	}
                DB::table('orders')->where('id',$request->order_id)->update(['total_amount'=>$amount]);
                $data['item_price']=$item->item_price;
                $data['item_name']=$item->item_name;
                $data['item_image']=$item->item_image;
                 $data['id']=$data1;
              
                $data['success']='Data inserted successfully!';
                return response()->json($data);
              }
                $data=array();
                $data['error']=$validator->errors()->all();
                return response()->json($data);

     }

         public function editorderdetails (Request $request){
	 		 $data=DB::table('order_details')->where('id',$request->id)->first();
			     return response()->json($data);
			  }

        public function updateorderdetails (Request $request){
              $validator = Validator::make($request->all(), [
            'order_idup' => 'required',
            'item_idup' => 'required',
            'item_quantityup' => 'required',
           
        ]);
        
        
         if ($validator->passes()) {
			     $data=array();
               $data['order_id']=$request->order_idup;
              // $data['user_id']=$request->user_id;
               $data['item_id']=$request->item_idup;
               $data['item_quantity']=$request->item_quantityup;
               $data['created_at']=Carbon::now();
                $data['updated_at']=now();
            $item=DB::table('menu_items')->where('id',$request->item_idup)->first();
               $data['item_amount']=$item->item_price*$request->item_quantityup;

                $data1=DB::table('order_details')->where('id',$request->hidden_idup)->update($data);
                $add=DB::table('order_details')->where('order_id',$request->order_idup)->get();
              	$amount=0;
              	foreach ($add as $key) {
              		$amount=$amount+$key->item_amount;
              	}
                DB::table('orders')->where('id',$request->order_idup)->update(['total_amount'=>$amount]);

                $data['item_price']=$item->item_price;
                $data['item_name']=$item->item_name;
                $data['item_image']=$item->item_image;
                
                $data['id']=$request->hidden_idup;
                $data['success']='Data updated!';
			        return response()->json($data);
            }
              $data=array();
        $data['error']=$validator->errors()->all();
        return response()->json($data);

			  }
          public function deleteorderdetails (Request $request){
                   $data=array();
	               $data['id']=$request->id;
	               $data['success']='Data Deleted successfully!';

	               $add2=DB::table('order_details')->where('id',$request->id)->first();
	               $order_id=$add2->order_id;
                     //return response()->json($add2->order_id);
	               DB::table('order_details')->where('id',$request->id)->delete();

                    $add=DB::table('order_details')->where('order_id',$order_id)->get();
	              	$amount=0;
	              	foreach ($add as $key) {
	              		$amount=$amount+$key->item_amount;
	              	}
	                DB::table('orders')->where('id',$add2->order_id)->update(['total_amount'=>$amount]);
                      return response()->json($data);
	            }
}
