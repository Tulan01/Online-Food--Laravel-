<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; 
use DB;
use Validator;
class DeliveryAddresssController extends Controller
{


        public function __construct()
    {  
        $this->middleware('auth:admin');
    }






    public function viewaddressvalue () {

    	$data=DB::table('delivery_addressses')->get();

    	      return view ('backend.pages.address',compact('data'));
    }

    public function editaddressvalue (Request $request){

	 	 $data=DB::table('delivery_addressses')->where('id',$request->id)->first();
			 return response()->json($data);
	 }

    public function updateaddressvalue (Request $request){
                $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'user_id' => 'required',
            'add' => 'required',
            'add2' => 'required',
            'city' => 'required',
            'country' => 'required',
            'post_code' => 'required',
           
        ]);
        
        if ($validator->passes()) {
              $data=array();
              $data['user_id']=$request->user_id;
              $data['order_id']=$request->order_id;
              $data['add']=$request->add;
              $data['add2']=$request->add2;
              $data['city']=$request->city;
              $data['country']=$request->country;
              $data['post_code']=$request->post_code;
              $data['created_at']=Carbon::now();
              $data['updated_at']=now();
            
	 	      DB::table('delivery_addressses')->where('id',$request->hidden_idup)->update($data);

               $data['id']=$request->hidden_idup;
           $data['success']='Data updated!';
           return response()->json($data);
           }

        $data=array();
        $data['error']=$validator->errors()->all();
        return response()->json($data);       
		
	 }
	  public function deleteaddressvalue (Request $request){
                    $data=array();
         $data['id']=$request->id;
         $data['success']='Data Deleted successfully!';
        $value=DB::table('delivery_addressses')->where('id',$request->id)->delete();
                  return response()->json($data);

	 }
}
