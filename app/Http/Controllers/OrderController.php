<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
use Carbon\Carbon; 
use Validator;
class OrderController extends Controller
{ 



   public function __construct()
    {  
        $this->middleware('auth:admin');
    }


    public function order () {
    	$data=DB::table('orders')->get();
    	$user=DB::table('users')->get();
    	return view ('backend.pages.order',compact('data','user'));
    }

    public function editordervalue (Request $request){
    	$data=DB::table('orders')->where('id',$request->id)->first();
    			return response()->json($data);
    }


    public function updateordervalue (Request $request){

    $validator = Validator::make($request->all(), [
            'user_idup' => 'required',
            'order_dateup' => 'required',
            'total_amountup' => 'required',
            'order_statusup' => 'required',
           
        ]);

      if ($validator->passes()) {
    	$data=array();
    	$data['user_id']=$request->user_idup;
    	$data['order_date']=$request->order_dateup;
    	$data['total_amount']=$request->total_amountup;
    	$data['order_status']=$request->order_statusup;
    	$data['created_at']=Carbon::now();
         $data['updated_at']=now();

    	DB::table('orders')->where('id',$request->hidden_idup)->update($data);

        $data1=DB::table('delivery_addressses')->where('order_id',$request->hidden_idup)->get();

        foreach($data1 as $key){
        DB::table('delivery_addressses')->where('order_id',$request->hidden_idup)->update(['user_id'=>$request->user_idup]);
        }

         $data2=DB::table('payments')->where('order_id',$request->hidden_idup)->get();

        foreach($data2 as $key1){
        DB::table('payments')->where('order_id',$request->hidden_idup)->update(['user_id'=>$request->user_idup]);
        }
        
        $data['id']=$request->hidden_idup;
        $data['success']='Data updated!';
        return response()->json($data);
       }
        else{
               $data=array();
                $data['error']=$validator->errors()->all();
                return response()->json($data);
          }

    }
    
	    public function deleteordervalue (Request $request){
	    	 $data=array();
	         $data['id']=$request->id;
	         $data['success']='Data Deleted successfully!';
	       
	        $value=DB::table('order')->where('id',$request->id)->delete();
	        $value=DB::table('delivery_addressses')->where('order_id',$request->id)->delete();
	        $value=DB::table('payments')->where('order_id',$request->id)->delete();
	        $value=DB::table('order_details')->where('order_id',$request->id)->delete();
	      return response()->json($data);

	    }
	    public function changeordervalue (Request $request){
    	//return response()->json($request);
    	$value=DB::table('orders')->where('id',$request->id)
                                   ->first();
        if($value->order_status=='Active'){
    	 DB::table('orders')->where('id',$request->id)
                            ->update(['order_status'=>'Inactive']);
        }
        else{
    	 DB::table('orders')->where('id',$request->id)
                            ->update(['order_status'=>'Active']);
        }

         $data=DB::table('orders')->where('id',$request->id)
                                     ->first();
       
           return response()->json($data);
    } 
}
