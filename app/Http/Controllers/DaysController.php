<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Validator;
class DaysController extends Controller
{   
        public function __construct()
    {  
        $this->middleware('auth:admin');
    }




    public function viewdays () {
      $data=DB::table('days')
                  ->get();
            
    	return view('backend.pages.days',compact('data'));
    }


    public function adddays (Request $request){
        $validator = Validator::make($request->all(), [
            'days_name' => 'required|unique:days',
            'days_name_short' => 'required',
            'days_status' => 'required',
           
        ]);
        
        
        if ($validator->passes()) {

                $data=array();
                $data['days_name']=$request->days_name;
                $data['days_name_short']=$request->days_name_short;
                $data['days_status']=$request->days_status;
                $data['created_at']=Carbon::now();
                $data['updated_at']=now();

                $data1=DB::table('days')->insertGetId($data);
            

                $data['id']=$data1;
              
                $data['success']='Data inserted successfully!';
                return response()->json($data);
           
        }
   
        $data=array();
        $data['error']=$validator->errors()->all();
        return response()->json($data);
    
    }
  


    public function editdaysvalue (Request $request){
    	 $data=DB::table('days')->where('id',$request->id)->first();

        return response()->json($data);
    }
    public function updatedaysvalue (Request $request){
         $validator = Validator::make($request->all(), [
            'days_nameup' => 'required|unique:days',
            'days_name_shortup' => 'required',
            'days_statusup' => 'required',
           
        ]);
       if ($validator->passes()) {

        $data=array();
        $data['days_name']=$request->days_nameup;
        $data['days_name_short']=$request->days_name_shortup;
        $data['days_status']=$request->days_statusup;
        $data['created_at']=Carbon::now();
    	$data['updated_at']=now();
       
        DB::table('days')->where('id',$request->hidden_idup)->update($data);
       
        $data['id']=$request->hidden_idup;
        $data['success']='Data updated!';
        return response()->json($data);

        }
   
        $data=array();
        $data['error']=$validator->errors()->all();
        return response()->json($data);
       

    }

    
    public function deletedaysvalue (Request $request){
    	 $data=array();
         $data['id']=$request->id;
         $data['success']='Data Deleted successfully!';
       
        $value=DB::table('days')->where('id',$request->id)->delete();
      return response()->json($data);

    }
    public function changedaysvalue (Request $request){
    	//return response()->json($request);
    	$value=DB::table('days')->where('id',$request->id)
                                   ->first();
        if($value->days_status=='Active'){
    	 DB::table('days')->where('id',$request->id)
                            ->update(['days_status'=>'Inactive']);
        }
        else{
    	 DB::table('days')->where('id',$request->id)
                            ->update(['days_status'=>'Active']);
        }

         $data=DB::table('days')->where('id',$request->id)
                                     ->first();
       
           return response()->json($data);
    } 
}
