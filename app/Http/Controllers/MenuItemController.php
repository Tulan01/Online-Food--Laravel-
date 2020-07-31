<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Validator;
class MenuItemController extends Controller
{

   public function __construct()
    {  
        $this->middleware('auth:admin');
    }



     public function viewmenuitem () {
      $data=DB::table('menu_items')
                  ->join('catagories','menu_items.catagory_id','catagories.id')
                  ->select('menu_items.*','catagories.catagory_name')
                  ->get();
      $data1=DB::table('catagories')->get();  
      
    	return view('backend.pages.menuitem',compact('data','data1'));
    }
    
     public function addmenuitem (Request $request){
           $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'catagory_id' => 'required|unique:days_menus',
            'item_details' => 'required',
            'item_price' => 'required',
            'item_status' => 'required',
            'item_image' => 'required',
           
        ]);

       
      if ($validator->passes()) {
        $data=array();
        $data['item_name']=$request->item_name;
        $data['catagory_id']=$request->catagory_id;
        $data['item_details']=$request->item_details;
        $data['item_price']=$request->item_price;
        $data['item_status']=$request->item_status;
        $data['created_at']=Carbon::now();
      	$data['updated_at']=now();
        $image = $request->file('image');
         //return response()->json($request);
        if($image){
        $image_name=hexdec(uniqid());
        $ext=strtolower($image->getClientOriginalExtension());
        $image_full_name=$image_name.'.'.$ext; 
        $upload_path='images/Menu_item/';
        $image_url=$upload_path.$image_full_name; 
        $success=$image->move($upload_path,$image_full_name);
        $data['item_image']=$image_url;
        // return response()->json($data);
        } 
        $data1=DB::table('menu_items')->insertGetId($data);
        
         $data3=DB::table('catagories')->where('id',$request->catagory_id)->first();
         $data['catagory_name']=$data3->catagory_name;

        $data['id']=$data1;
        $data['success']='Data inserted successfully!';
        return response()->json($data);

      }
       $data=array();
        $data['error']=$validator->errors()->all();
        return response()->json($data);
    } 

    public function editmenuitemvalue (Request $request){
       $data=DB::table('menu_items')->where('id',$request->id)->first();

        return response()->json($data);
    }
    
     public function updatemenuitemvalue (Request $request){
             $validator = Validator::make($request->all(), [
            'item_nameup' => 'required',
            'catagory_idup' => 'required|unique:days_menus',
            'item_detailsup' => 'required',
            'item_priceup' => 'required',
            'item_statusup' => 'required',
            'item_imageup' => 'required',
           
        ]);

       
      if ($validator->passes()) {
        $data=array();
        $data['item_name']=$request->item_nameup;
        $data['catagory_id']=$request->catagory_idup;
        $data['item_details']=$request->item_detailsup;
        $data['item_price']=$request->item_priceup;
        $data['item_status']=$request->item_statusup;
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
        $data['item_image']=$image_url;
        // return response()->json($data);
        $value=DB::table('menu_items')->where('id',$request->hidden_idup)->first();
        $img=$value->item_image;
        if($value){
          unlink($img);
        }
        DB::table('menu_items')->where('id',$request->hidden_idup)->update($data);
         $data3=DB::table('catagories')->where('id',$request->catagory_idup)->first();
            $data['catagory_name']=$data3->catagory_name;

        $data['id']=$request->hidden_idup;
        $data['success']='Data updated!';
        return response()->json($data);
        }
        else{
        DB::table('menu_items')->where('id',$request->hidden_idup)->update($data);

        $data1=DB::table('menu_items')->where('id',$request->hidden_idup)->pluck('item_image');
        $data['item_image']=$data1;
        $data3=DB::table('catagories')->where('id',$request->catagory_idup)->first();
        $data['catagory_name']=$data3->catagory_name;

        $data['id']=$request->hidden_idup;
        $data['success']='Data updated!';
        return response()->json($data);
         }
        }
         $data=array();
        $data['error']=$validator->errors()->all();
        return response()->json($data);
       }

      public function deletemenuitemvalue (Request $request){
         $data=array();
         $data['id']=$request->id;
         $data['success']='Data Deleted successfully!';
       
        $value=DB::table('menu_items')->where('id',$request->id)->delete();
        return response()->json($data);
       }

      public function changemenuitemvalue (Request $request){
      //return response()->json($request);
      $value=DB::table('menu_items')->where('id',$request->id)
                                   ->first();
        if($value->item_status=='Active'){
       DB::table('menu_items')->where('id',$request->id)
                            ->update(['item_status'=>'Inactive']);
        }
        else{
       DB::table('menu_items')->where('id',$request->id)
                            ->update(['item_status'=>'Active']);
        }

         $data=DB::table('menu_items')->where('id',$request->id)
                                     ->first();
         $data3=DB::table('catagories')->where('id',$data->catagory_id)->first();

        $data4=array();
        $data4['item_name']=$data->item_name;
        $data4['item_details']=$data->item_details;
        $data4['item_price']=$data->item_price;
        $data4['item_image']=$data->item_image;
        $data4['id']=$data->id;
        $data4['item_status']=$data->item_status;
        $data4['catagory_name']=$data3->catagory_name;
       
           return response()->json($data4);
    } 
}
