<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Validator;
class DaysMenuController extends Controller
{


      public function __construct()
    {  
        $this->middleware('auth:admin');
    }




    public function viewdaysmenu () {
      $data=DB::table('days_menus')
                  ->join('days','days_menus.days_id','days.id')
                  ->select('days_menus.*','days.days_name')
                  ->get();
    $data1=DB::table('days')->get();         
    	return view('backend.pages.daysmenu',compact('data','data1'));
    }
    
    public function adddaysmenu (Request $request){
          $validator = Validator::make($request->all(), [
            'days_menu_details' => 'required',
            'days_id' => 'required|unique:days_menus',
            'days_menu_price' => 'required',
            'days_menu_status' => 'required',
            'days_menu_image' => 'required',
           
        ]);
        
       if ($validator->passes()) { 
        $data=array();
        $data['days_menu_details']=$request->days_menu_details;
        $data['days_id']=$request->days_id;
        $data['days_menu_price']=$request->days_menu_price;
        $data['days_menu_status']=$request->days_menu_status;
        $data['created_at']=Carbon::now();
      	$data['updated_at']=now();
        $image = $request->file('image');
         //return response()->json($request);
        if($image){
        $image_name=hexdec(uniqid());
        $ext=strtolower($image->getClientOriginalExtension());
        $image_full_name=$image_name.'.'.$ext; 
        $upload_path='images/Days_menu/';
        $image_url=$upload_path.$image_full_name; 
        $success=$image->move($upload_path,$image_full_name);
        $data['days_menu_image']=$image_url;
        // return response()->json($data);
        } 
        
        $data1=DB::table('days_menus')->insertGetId($data);
        
         $data3=DB::table('days')->where('id',$request->days_id)->first();
         $data['days_name']=$data3->days_name;

        $data['id']=$data1;
        $data['success']='Data inserted successfully!';
        return response()->json($data);
      }
        $data=array();
        $data['error']=$validator->errors()->all();
        return response()->json($data);
    } 

     public function editdaysmenuvalue (Request $request){
    	 $data=DB::table('days_menus')->where('id',$request->id)->first();

        return response()->json($data);
    }

     public function updatedaysmenuvalue (Request $request){
        $validator = Validator::make($request->all(), [
            'days_menu_detailsup' => 'required',
            'days_idup' => 'required|unique:days_menus',
            'days_menu_priceup' => 'required',
            'days_menu_statusup' => 'required',
            'days_menu_imageup' => 'required',
           
        ]);
        
       if ($validator->passes()) {
       $data=array();
        $data['days_menu_details']=$request->days_menu_detailsup;
        $data['days_id']=$request->days_idup;
        $data['days_menu_price']=$request->days_menu_priceup;
        $data['days_menu_status']=$request->days_menu_statusup;
        $data['created_at']=Carbon::now();
    	  $data['updated_at']=now();
        $image = $request->file('imageup');

        if($image){
        $image_name=hexdec(uniqid());
        $ext=strtolower($image->getClientOriginalExtension());
        $image_full_name=$image_name.'.'.$ext; 
        $upload_path='images/Days_menu/';
        $image_url=$upload_path.$image_full_name; 
        $success=$image->move($upload_path,$image_full_name);
        $data['days_menu_image']=$image_url;
        // return response()->json($data);
        $value=DB::table('days_menus')->where('id',$request->hidden_idup)->first();
        $img=$value->days_menu_image;
        if($value){
          unlink($img);
        }
        DB::table('days_menus')->where('id',$request->hidden_idup)->update($data);
         $data3=DB::table('days')->where('id',$request->days_idup)->first();
            $data['days_name']=$data3->days_name;

        $data['id']=$request->hidden_idup;
        $data['success']='Data updated!';
        return response()->json($data);
        }
        else{
        DB::table('days_menus')->where('id',$request->hidden_idup)->update($data);

        $data1=DB::table('days_menus')->where('id',$request->hidden_idup)->pluck('days_menu_image');
        $data['days_menu_image']=$data1;
         $data3=DB::table('days')->where('id',$request->days_idup)->first();
         $data['days_name']=$data3->days_name;

        $data['id']=$request->hidden_idup;
        $data['success']='Data updated!';
        return response()->json($data);
         }
        }
        $data=array();
        $data['error']=$validator->errors()->all();
        return response()->json($data);
    }
    public function deletedaysmenuvalue (Request $request){
    	 $data=array();
         $data['id']=$request->id;
         $data['success']='Data Deleted successfully!';
       
        $value=DB::table('days_menus')->where('id',$request->id)->delete();
        return response()->json($data);

    }
    public function changedaysmenuvalue (Request $request){
    	//return response()->json($request);
    	$value=DB::table('days_menus')->where('id',$request->id)
                                   ->first();
        if($value->days_menu_status=='Active'){
    	 DB::table('days_menus')->where('id',$request->id)
                            ->update(['days_menu_status'=>'Inactive']);
        }
        else{
    	 DB::table('days_menus')->where('id',$request->id)
                            ->update(['days_menu_status'=>'Active']);
        }

         $data=DB::table('days_menus')->where('id',$request->id)
                                     ->first();
         $data3=DB::table('days')->where('id',$data->days_id)->first();

        $data4=array();
        $data4['days_menu_details']=$data->days_menu_details;
        $data4['days_menu_image']=$data->days_menu_image;
        $data4['days_menu_price']=$data->days_menu_price;
        $data4['id']=$data->id;
        $data4['days_menu_status']=$data->days_menu_status;
        $data4['days_name']=$data3->days_name;
       
           return response()->json($data4);
    } 
  
}
