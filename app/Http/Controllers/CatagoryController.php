<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
class CatagoryController extends Controller
{

   public function __construct()
    {  
        $this->middleware('auth:admin');
    }


    public function viewcatagory () {
      $data=DB::table('catagories')
                  ->get();
    	return view('backend.pages.catagory',compact('data'));
    }


    public function addcatagory (Request $request){
        $validator = Validator::make($request->all(), [
            'catagory_name' => 'required|unique:catagories',
            'catagory_status' => 'required',
           
        ]);
     if ($validator->passes()) {
        $data=array();
        $data['catagory_name']=$request->catagory_name;
        $data['catagory_status']=$request->catagory_status;
        $data1=DB::table('catagories')->insertGetId($data);
        $data['id']=$data1;
        $data['success']='Data inserted successfully!';
        return response()->json($data);
      }
        $data=array();
        $data['error']=$validator->errors()->all();
        return response()->json($data);
    }
  

    public function editcatagoryvalue (Request $request){
    	 $data=DB::table('catagories')->where('id',$request->id)->first();
        return response()->json($data);
    }
    public function updatecatagoryvalue (Request $request){
          $validator = Validator::make($request->all(), [
            'catagory_namup' => 'required|unique:catagories',
            'catagory_statusup' => 'required',
           
        ]);
      if ($validator->passes()) {
        
        $data=array();
        $data['catagory_name']=$request->catagory_nameup;
        $data['catagory_status']=$request->catagory_statusup;
        $data1=DB::table('catagories')->where('id',$request->hidden_idup)->update($data);
        $data['id']=$request->hidden_idup;
        $data['success']='Data updated!';
          return response()->json($data);
         }
        $data=array();
        $data['error']=$validator->errors()->all();
        return response()->json($data);
    }


      public function deletecatagoryvalue (Request $request){
         $data=array();
         $data['id']=$request->id;
         $data['success']='Data Deleted successfully!';
         $value=DB::table('catagories')->where('id',$request->id)->delete();
          return response()->json($data);

    }

   public function changecatagoryvalue (Request $request){
      //return response()->json($request);
      $value=DB::table('catagories')->where('id',$request->id)
                                   ->first();
        if($value->catagory_status=='Active'){
       DB::table('catagories')->where('id',$request->id)
                            ->update(['catagory_status'=>'Inactive']);
        }
        else{
       DB::table('catagories')->where('id',$request->id)
                            ->update(['catagory_status'=>'Active']);
        }

         $data=DB::table('catagories')->where('id',$request->id)
                                     ->first();
       
           return response()->json($data);
    } 
}
