<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Carbon\Carbon;

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

  
    // User register routes
  Route:: post('/register/user','Auth\RegisterController@create');

    // Users API routes
  Route::apiResource('user','Api\User\UserController');
  //  Parmamnently delete user
  Route::get('user/parmanently-delete/{id}','Api\User\UserController@parmanentlyDelete');
  // Restore user
   Route::get('user/restore/{id}','Api\User\UserController@restoreUser');
  // Deleted users
   Route::get('users/deleted','Api\User\UserController@deletedusers');

   //send email verification
   Route::get('send-email-verification/{email}','Web\Auth\EmailVerificationController@sendVerificationEmailLink');

  // -------------------------------------------------------------------------------------//
    // Order API routes
  Route::apiResource('order','Api\Order\OrderController');
    // Get deleted orders
  Route::get('order/fetch-deleted','Api\Order\OrderController@fetchDeleted');
  // mark 
  Route::get('order/mark/{id}/{value}/{date}','Api\Order\OrderController@markOrder');
  // mark 
  Route::get('order/mark-paid/{id}/{value}/{date}','Api\Order\OrderController@markOrderpaid');
  // mark 
  Route::get('order/collect-cash/{id}/{amount}/{date}','Api\Order\OrderController@markOrdercollectCash');
  //tack order
  Route::get('/track-order/{order_id}','Api\Order\OrderController@trackOrder');

    // Restore order
  Route::get('order/restore/{id}','Api\Order\OrderController@restore');
   //  Parmamnently delete order
  Route::get('order/parmanently-delete/{id}','Api\Order\OrderController@parmanentlyDelete');

  // OrderItem API route
  Route::apiResource('order-item','Api\OrderItem\OrderItemController');

    // Qr code API routes
  Route::apiResource('qrcode','Api\QrCode\QrCodeController');
    // Get deleted qr codes
  Route::get('qrcode/fetch-deleted','Api\QrCode\QrCodeController@fetchDeleted');

    // Restore qr codes
  Route::get('qrcode/restore/{id}','Api\QrCode\QrCodeController@restore');

    //  Parmamnently delete qr codes
  Route::get('qrcode/parmanently-delete/{id}','Api\QrCode\QrCodeController@parmanentlyDelete');

  //Generate Qr code routes
  Route::get('qrcode-generate/{restaurant_id}/{table_number?}','Api\QrCode\QrCodeGenerateController@generate')->name('qrcode-generate');

/*  ------------------------------------------------------------------------------------------------------------------------------------ */
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

// ------------------------------------------------------------------------------------------------------//

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
    Route::get('menu-item/duplicate/{id}','Api\MenuItem\MenuItemController@duplicate');
    // Get deleted MenuItem
  Route::get('menu-item/fetch-deleted','Api\MenuItem\MenuItemController@fetchDeleted');
    // Restore MenuItem
  Route::get('menu-item/restore/{id}','Api\MenuItem\MenuItemController@restore');
    //  Parmamnently delete MenuItem
  Route::get('menu-item/parmanently-delete/{id}','Api\MenuItem\MenuItemController@parmanentlyDelete');

// ---------------------------------------------------------------------------------------------------------------------//

    // SubMenu API routes routes
  Route::apiResource('sub-menu','Api\SubMenu\SubMenuController');
  Route::get('sub-menu/toggle-publish/{id}/{value}','Api\SubMenu\SubMenuController@togglePublish');
  Route::get('sub-menu/duplicate/{id}','Api\SubMenu\SubMenuController@duplicate');
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

  // mobile menu items route
    Route::get('/{restaurant_name}/menu-item/{sub_menu_id}',[App\Http\Controllers\Web\MobileMenu\MobileMenuController::class, 'getMenuItems'])->name('mobile menu');
  
  // Qr code scans route
    Route::get('/qr-code-scan/{restaurant_id}',[App\Http\Controllers\Api\QrCodeScan\QrCodeScanController::class, 'countQrCodeScan'])->name('qr-code-scan');
  
// ------------------Reports routes ---------------------------------
 Route::get('/summary-reports/orders/{restaurant_id}',[App\Http\Controllers\Api\Report\ReportController::class, 'fetchSummayReportOrders'])->name('fetch-reports');
 Route::get('/custom-reports/orders/{restaurant_id}/{period}/{order_type}/{table_number}/{order_status}',[App\Http\Controllers\Api\Report\ReportController::class, 'fetchCustomReportOrders'])->name('fetch-reports');
  
  // Reconciliation payments
  Route::get('/admin/fetch-reconciliations', [App\Http\Controllers\Web\Admin\SubscriptionReconciliationController::class, 'fetchReconciliations'])->name('all-subscription-payments');
  Route::get('/admin/find-user/{email}', [App\Http\Controllers\Web\Admin\SubscriptionReconciliationController::class, 'getUserAccount'])->name('get-user');
  Route::get('/admin/reconcile-payment/{userID}/{paymentID}', [App\Http\Controllers\Web\Admin\SubscriptionReconciliationController::class, 'reconcilePayment'])->name('reconcile-payment');
  Route::get('/admin/search-payment/{payment_email}', [App\Http\Controllers\Web\Admin\SubscriptionReconciliationController::class, 'searchPayment'])->name('search-payment');


   //============================Stripe Pay  routes ===================//
    //  stripe inf outes 
    Route::post('/banking/update-stripe-info','Api\Banking\BankingController@updateStripeInfo');

    // stripe pay package subscription checkout route
    Route::post('/stripe-pay-subscription-checkout',[App\Http\Controllers\Api\StripePay\StripePayController::class, 'subscriptionCheckout'])->name('stripe-subscription-checkout');
    // Route::get('/stripe-webhook',[App\Http\Controllers\Api\StripePay\StripePayController::class, 'handleChargeEvents'])->name('stripe-charge-succsessfull');
    Route::post('/stripe-webhook',[App\Http\Controllers\Api\StripePay\StripePayController::class, 'handleSubscriptionWebhook'])->name('stripe-charge-succsessfull');
  
    // stripe pay order checkout route
    Route::post('/stripe-pay-order-checkout',[App\Http\Controllers\Api\StripePay\OrderPaymentsController::class, 'orderCheckout'])->name('stripe-order-checkout');
    // stripe pay order checkout route force expire session
    Route::get('/stripe-pay-order-checkout-expire-session/{restaurant_id}/{stripe_session_id}',[App\Http\Controllers\Api\StripePay\OrderPaymentsController::class, 'forceStripeSessionExpire'])->name('stripe-order-checkout-session-expire');
    // order payment webhook 
    Route::post('/stripe-order-webhook',[App\Http\Controllers\Api\StripePay\OrderPaymentsController::class, 'handleOrderWebhook'])->name('stripe-order-webhook');




Route::get('/simulate-package/{id}/{package_name}/{period}', function ($id, $package_name, $period) {  
  $days = 0;
  if($period == 'monthly') $days = 30;
  else $days = 365;
    $user = User::findOrFail($id);
    $user->update([
      'package_type'=> $package_name,
      'registration_date' => Carbon::now(),
      'registration_expiry' => Carbon::now()->addDays($days),
      'package_period' => $period,
      'registration_status' => 'registered',
    ]);
    return response()->json([
      'success' => true,
      'message' => 'package toggled',
      'data' => $user
    ],200);
});


Route::fallback(function() {
        return response()->json([
            'success'=> false,
            'message' => 'No such route found on this server',
            ], 404);
});