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
  // Restore order
   Route::get('order/restore/{id}','Api\Order\OrderController@restore');
  //  Parmamnently delete order
  Route::get('order/parmanently-delete/{id}','Api\Order\OrderController@parmanentlyDelete');



  



Route::fallback(function() {
        return response()->json([
            'success'=> false,
            'message' => 'No such route found on this serve',
            ], 404);
});