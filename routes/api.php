<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// prevent mixed content error in production
if (App::environment('production')) {
    URL::forceScheme('https');
}

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

//     return $request->user();
// });

  



    // Users API routes
  Route::apiResource('user','Api\User\UserController');
  //  Parmamnently delete user
  Route::get('user/parmanently-delete/{id}','Api\User\UserController@parmanentlyDelete');
  // Restore user
   Route::get('user/restore/{id}','Api\User\UserController@restoreUser');

    // Orders API routes
  Route::apiResource('order','Api\Order\OrderController');
    // Get deleted orders
  Route::get('order/fetch-deleted','Api\Order\OrderController@fetchDeleted');
    // Restore order
  Route::get('order/restore/{id}','Api\Order\OrderController@restore');
   //  Parmamnently delete order
  Route::get('order/parmanently-delete/{id}','Api\Order\OrderController@parmanentlyDelete');

    // Qr code API routes
  Route::apiResource('qrcode','Api\QrCode\QrCodeController');
    // Get deleted qr codes
  Route::get('qrcode/fetch-deleted','Api\QrCode\QrCodeController@fetchDeleted');
    // Restore qr codes
  Route::get('qrcode/restore/{id}','Api\QrCode\QrCodeController@restore');
    //  Parmamnently delete qr codes
  Route::get('qrcode/parmanently-delete/{id}','Api\QrCode\QrCodeController@parmanentlyDelete');

    // Restaurant API routes routes
  Route::apiResource('restaurant','Api\Restaurant\RestaurantController');
    // Get deleted restaurant
  Route::get('restaurant/fetch-deleted','Api\Restaurant\RestaurantController@fetchDeleted');
    // Restore restaurant
  Route::get('restaurant/restore/{id}','Api\Restaurant\RestaurantController@restore');
    //  Parmamnently delete restaurant
  Route::get('restaurant/parmanently-delete/{id}','Api\Restaurant\RestaurantController@parmanentlyDelete');


    // Table API routes routes
  Route::apiResource('table','Api\Table\TableController');
    // Get deleted Table
  Route::get('table/fetch-deleted','Api\Table\TableController@fetchDeleted');
    // Restore Table
  Route::get('table/restore/{id}','Api\Table\TableController@restore');
    //  Parmamnently delete Table
  Route::get('table/parmanently-delete/{id}','Api\Table\TableController@parmanentlyDelete');

    // Menu API routes routes
  Route::apiResource('menu','Api\Menu\MenuController');
    // Get deleted menu
  Route::get('menu/fetch-deleted','Api\Menu\MenuController@fetchDeleted');
  Route::get('menu/duplicate/{id}','Api\Menu\MenuController@duplicate');
  Route::get('menu/toggle-publish/{id}/{value}','Api\Menu\MenuController@togglePublished');
    // Restore menu
  Route::get('menu/restore/{id}','Api\Menu\MenuController@restore');
    //  Parmamnently delete menu
  Route::get('menu/parmanently-delete/{id}','Api\Menu\MenuController@parmanentlyDelete');
  
    // MenuItem API routes routes
  Route::apiResource('menu-item','Api\MenuItem\MenuItemController');
   Route::get('menu-item/toggle-publish/{id}/{value}','Api\MenuItem\MenuItemController@togglePublish');
    // Get deleted MenuItem
  Route::get('menu-item/fetch-deleted','Api\MenuItem\MenuItemController@fetchDeleted');
    // Restore MenuItem
  Route::get('menu-item/restore/{id}','Api\MenuItem\MenuItemController@restore');
    //  Parmamnently delete MenuItem
  Route::get('menu-item/parmanently-delete/{id}','Api\MenuItem\MenuItemController@parmanentlyDelete');


    // SubMenu API routes routes
  Route::apiResource('sub-menu','Api\SubMenu\SubMenuController');
  Route::get('sub-menu/toggle-publish/{id}/{value}','Api\SubMenu\SubMenuController@togglePublish');
    // Get deleted SubMenu
  Route::get('sub-menu/fetch-deleted','Api\SubMenu\SubMenuController@fetchDeleted');
    // Restore SubMenu
  Route::get('sub-menu/restore/{id}','Api\SubMenu\SubMenuController@restore');
    //  Parmamnently delete SubMenu
  Route::get('sub-menu/parmanently-delete/{id}','Api\SubMenu\SubMenuController@parmanentlyDelete');

    // Payment API routes routes
  Route::apiResource('payment','Api\Payment\PaymentController');
    // Get deleted Payment
  Route::get('payment/fetch-deleted','Api\Payment\PaymentController@fetchDeleted');
    // Restore Payment
  Route::get('payment/restore/{id}','Api\Payment\PaymentController@restore');
    //  Parmamnently delete Payment
  Route::get('payment/parmanently-delete/{id}','Api\Payment\PaymentController@parmanentlyDelete');

//Generate Qr code routes
Route::get('qrcode-generate','Api\QrCode\QrCodeGenerateController@generate')->name('qrcode-generate');

  

Route::fallback(function() {
        return response()->json([
            'success'=> false,
            'message' => 'No such route found on this server',
            ], 404);
});