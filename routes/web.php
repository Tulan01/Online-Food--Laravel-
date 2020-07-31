<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//route add to cart
Route::post('/addcart','CartController@addcart')->name('addcart');
Route::post('/deletecart','CartController@deletecart')->name('deletecart');
Route::post('/decreasecart','CartController@decreasecart')->name('decreasecart');
Route::post('/increasecart','CartController@increasecart')->name('increasecart');


//route for display

Route::get('/','DisplayController@index')->name('index');
Route::get('menu','DisplayController@menu')->name('menu');
Route::get('order','DisplayController@order')->name('order');

Route::get('showcart','DisplayController@showcart')->name('showcart');

//routr for checkOut
Route::get('checkout','CheckOutController@Checkout')->name('checkout');
Route::post('savecheckout','CheckOutController@savecheckout')->name('savecheckout');
Route::get('reserve','CheckOutController@reserve')->name('reserve');
Route::post('cancelorder','CheckOutController@cancelorder')->name('cancelorder');




Route::get('find','DisplayController@find')->name('find');




//auth route
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//route for admin 
Route::get('/adminhome','AdminController@adminhome')->name('adminhome');


Route::get('/admin','AdminController@admin')->name('admin');
Route::get('/adminlogin','AdminloginController@showloginform')->name('adminlogin');
Route::post('/dologin','AdminloginController@dologin')->name('dologin');
Route::post('/adminlogout','AdminloginController@adminlogout')->name('adminlogout');

Route::get('/showadminform','AdminRegisterController@showadminform')->name('showadminform');
Route::post('/adminregister','AdminRegisterController@adminregister')->name('adminregister');



//subcription frontend route 
Route::get('subscription','SubscriptionController@subscription')->name('subscription');
Route::post('subsadd','SubscriptionController@subsadd')->name('subsadd');
Route::post('fetechvalue','SubscriptionController@fetechvalue')->name('fetechvalue');









//route for catagory

Route::get('viewcatagory','CatagoryController@viewcatagory')->name('viewcatagory');
Route::post('addcatagory','CatagoryController@addcatagory')->name('addcatagory');
Route::post('editcatagoryvalue','CatagoryController@editcatagoryvalue')->name('editcatagoryvalue');
Route::post('updatecatagoryvalue','CatagoryController@updatecatagoryvalue')->name('updatecatagoryvalue');
Route::post('deletecatagoryvalue','CatagoryController@deletecatagoryvalue')->name('deletecatagoryvalue');
Route::post('changecatagoryvalue','CatagoryController@changecatagoryvalue')->name('changecatagoryvalue');

//menu_item route
Route::get('viewmenuitem','MenuItemController@viewmenuitem')->name('viewmenuitem');
Route::post('addmenuitem','MenuItemController@addmenuitem')->name('addmenuitem');
Route::post('editmenuitemvalue','MenuItemController@editmenuitemvalue')->name('editmenuitemvalue');
Route::post('updatemenuitemvalue','MenuItemController@updatemenuitemvalue')->name('updatemenuitemvalue');
Route::post('deletemenuitemvalue','MenuItemController@deletemenuitemvalue')->name('deletemenuitemvalue');
Route::post('changemenuitemvalue','MenuItemController@changemenuitemvalue')->name('changemenuitemvalue');

//route for days_menu

Route::get('viewdaysmenu','DaysMenuController@viewdaysmenu')->name('viewdaysmenu');
Route::post('adddaysmenu','DaysMenuController@adddaysmenu')->name('adddaysmenu');
Route::post('editdaysmenuvalue','DaysMenuController@editdaysmenuvalue')->name('editdaysmenuvalue');
Route::post('updatedaysmenuvalue','DaysMenuController@updatedaysmenuvalue')->name('updatedaysmenuvalue');
Route::post('deletedaysmenuvalue','DaysMenuController@deletedaysmenuvalue')->name('deletedaysmenuvalue');
Route::post('changedaysmenuvalue','DaysMenuController@changedaysmenuvalue')->name('changedaysmenuvalue');


//route for days

Route::get('viewdays','DaysController@viewdays')->name('viewdays');
Route::post('adddays','DaysController@adddays')->name('adddays');
Route::post('editdaysvalue','DaysController@editdaysvalue')->name('editdaysvalue');
Route::post('updatedaysvalue','DaysController@updatedaysvalue')->name('updatedaysvalue');
Route::post('deletedaysvalue','DaysController@deletedaysvalue')->name('deletedaysvalue');
Route::post('changedaysvalue','DaysController@changedaysvalue')->name('changedaysvalue');


//route for admin side order

Route::get('order','OrderController@order')->name('order');

Route::post('addorder','OrderController@addorder')->name('addorder');
Route::post('editordervalue','OrderController@editordervalue')->name('editordervalue');
Route::post('updateordervalue','OrderController@updateordervalue')->name('updateordervalue');
Route::post('deleteordervalue','OrderController@deleteordervalue')->name('deleteordervalue');
Route::post('changeordervalue','OrderController@changeordervalue')->name('changeordervalue');


//order details route

Route::get('vieworderdeatails{id}','OrderDetailsController@vieworderdeatails')->name('vieworderdeatails');
Route::post('addorderdetails','OrderDetailsController@addorderdetails')->name('addorderdetails');
Route::post('editorderdetails','OrderDetailsController@editorderdetails')->name('editorderdetails');
Route::post('updateorderdetails','OrderDetailsController@updateorderdetails')->name('updateorderdetails');
Route::post('deleteorderdetails','OrderDetailsController@deleteorderdetails')->name('deleteorderdetails');

//address route

Route::get('viewaddressvalue','DeliveryAddresssController@viewaddressvalue')->name('viewaddressvalue');
Route::post('editaddressvalue','DeliveryAddresssController@editaddressvalue')->name('editaddressvalue');
Route::post('updateaddressvalue','DeliveryAddresssController@updateaddressvalue')->name('updateaddressvalue');
Route::post('deleteaddressvalue','DeliveryAddresssController@deleteaddressvalue')->name('deleteaddressvalue');

//payment route 

Route::get('viewpaymentvalue','PaymentController@viewpaymentvalue')->name('viewpaymentvalue');
Route::post('editpaymentvalue','PaymentController@editpaymentvalue')->name('editpaymentvalue');
Route::post('updatepaymentvalue','PaymentController@updatepaymentvalue')->name('updatepaymentvalue');
Route::post('deletepaymentvalue','PaymentController@deletepaymentvalue')->name('deletepaymentvalue');






