<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;
use Auth;
use URL;
class SubscriptionController extends Controller
{   


    public function __construct()
    {

        $value=explode("/", URL::full());
        $data=end($value);
        Session::put('url.intended',$data); 
        $this->middleware('auth');
    }


    public function subscription (){
     $data=DB::table('days_menus')
               ->join('days','days_menus.days_id','days.id')
               ->select('days_menus.*','days.days_name')
               ->where('days_menus.days_menu_status','Active')
               ->get();
     $days=DB::table('days')
                    ->where('days_status','Active')
                    ->get();

      $subscrip=DB::table('subscriptions')->get();
              session::put('active',4);
   	  return view ('frontend.pages.subscription',compact('data','days','subscrip'));
   }

     public function subsadd (Request $request){

           
            $fprice=0;
        foreach ($request->days_id as $key) {
        	   $c=0;
               $price=0;
         	$data1=DB::table('days_menus')
         	         ->where('days_id',$key)
         	         ->first();
         	$price=$data1->days_menu_price;
		    $data2=DB::table('days')
         	         ->where('id',$key)
         	         ->first();
        if($data2->days_name=='SUNDAY'){
		$startDate = Carbon::parse($request->start_date)->next(Carbon::SUNDAY); // Get the first friday.
		$endDate = Carbon::parse($request->end_date);

		 for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
		        $c=$c+1;
		   }
	     }
	      if($data2->days_name=='MONDAY'){
		$startDate = Carbon::parse($request->start_date)->next(Carbon::MONDAY); // Get the first friday.
		$endDate = Carbon::parse($request->end_date);

		 for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
		        $c=$c+1;
		   }
	     }
	       if($data2->days_name=='TUESDAY'){
		$startDate = Carbon::parse($request->start_date)->next(Carbon::TUESDAY); // Get the first friday.
		$endDate = Carbon::parse($request->end_date);

		 for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
		        $c=$c+1;
		   }
	     }
	     if($data2->days_name=='WEDNESDAY'){
		$startDate = Carbon::parse($request->start_date)->next(Carbon::WEDNESDAY); // Get the first friday.
		$endDate = Carbon::parse($request->end_date);

		 for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
		        $c=$c+1;
		   }
	     }
	      if($data2->days_name=='THURSDAY'){
		$startDate = Carbon::parse($request->start_date)->next(Carbon::THURSDAY); // Get the first friday.
		$endDate = Carbon::parse($request->end_date);

		 for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
		        $c=$c+1;
		   }
	     }

	     $price1=$price*$c;
         $fprice=$fprice+$price1;
	}

		 
        $data=array();
        $data['days_id']=json_encode($request->days_id);
        $data['user_id']=Auth::user()->id;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['price']=$fprice;
        $data['subcrip_status']='Active';
        $data['created_at']=Carbon::now();
    	$data['updated_at']=now();

    	DB::table('subscriptions')->insert($data);

        return redirect()->route('subscription');
     }



     public function fetechvalue (Request $request){
        $data=DB::table('subscriptions')->where('id',$request->id)->first();
         
         $a = json_decode($data->days_id);
         foreach ($a as $key) {
             $data1['days_id'][]=$key;
         }
        $data1['id']=$data->id;
        $data1['user_id']=$data->user_id;
        $data1['start_date']=$data->start_date;
        $data1['end_date']=$data->end_date;
        $data1['price']=$data->price;
        $data1['subcrip_status']=$data->subcrip_status;
        
        return response()->json($data1);
     }
}
