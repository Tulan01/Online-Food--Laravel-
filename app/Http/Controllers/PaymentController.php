<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
use Carbon\Carbon; 
use Validator;
class PaymentController extends Controller
{


        public function __construct()
    {  
        $this->middleware('auth:admin');
    }



	 public function viewpaymentvalue () {

    	$data=DB::table('payments')->get();

    	      return view ('backend.pages.payment',compact('data'));
    }

    public function editpaymentvalue (Request $request){

	 	 $data=DB::table('payments')->where('id',$request->id)->first();
			 return response()->json($data);
	 }

    public function updatepaymentvalue (Request $request){
            $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'item_id' => 'required',
            'pay_method' => 'required',
            'pay_status' => 'required',
           
        ]);
        
        
        if ($validator->passes()) {
              
              $data=array();
              $data['user_id']=$request->user_id;
              $data['order_id']=$request->order_id;
              $data['pay_method']=$request->pay_method;
              $data['pay_status']=$request->pay_status;
              $data['created_at']=Carbon::now();
              $data['updated_at']=now();
            
	 	      DB::table('payments')->where('id',$request->hidden_idup)->update($data);

               $data['id']=$request->hidden_idup;
              $data['success']='Data updated!';
              return response()->json($data);
        }
		   
                 $data=array();
                $data['error']=$validator->errors()->all();
                return response()->json($data);

	 }
	  public function deletepaymentvalue (Request $request){
                    $data=array();
           $data['id']=$request->id;
         $data['success']='Data Deleted successfully!';
        $value=DB::table('payments')->where('id',$request->id)->delete();
                  return response()->json($data);

	 }

    
}
