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

  



    // Users route
  Route::apiResource('user','Api\User\UserController');
  //  Parmamnently delete user
  Route::get('user/parmanently-delete/{id}','Api\User\UserController@parmanentlyDelete');
  // Restore user
   Route::get('user/restore/{id}','Api\User\UserController@restoreUser');

    // Orders route
  Route::apiResource('order','Api\Order\OrderController');
    // Get deleted orders
  Route::get('order/fetch-deleted','Api\Order\OrderController@fetchDeleted');
    // Restore order
  Route::get('order/restore/{id}','Api\Order\OrderController@restore');
   //  Parmamnently delete order
  Route::get('order/parmanently-delete/{id}','Api\Order\OrderController@parmanentlyDelete');

    // Qr code route
  Route::apiResource('qrcode','Api\QrCode\QrCodeController');
    // Get deleted qr codes
  Route::get('qrcode/fetch-deleted','Api\QrCode\QrCodeController@fetchDeleted');
    // Restore qr codes
  Route::get('qrcode/restore/{id}','Api\QrCode\QrCodeController@restore');
    //  Parmamnently delete qr codes
  Route::get('qrcode/parmanently-delete/{id}','Api\QrCode\QrCodeController@parmanentlyDelete');



  



Route::fallback(function() {
        return response()->json([
            'success'=> false,
            'message' => 'No such route found on this server',
            ], 404);
});