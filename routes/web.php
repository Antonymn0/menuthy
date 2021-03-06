<?php

use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Inertia\Inertia;

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
   // print orders route 
    Route::get('/{restaurant_id}/orders/print', [App\Http\Controllers\Web\Order\OrderController::class, 'printOrders']);
    
//========== PUBLIC ROUTES  ================
Route::get('/', function () {
    return view('welcome');
});
 // show vuejs user register form
   Route::get('register', function () { 
    $user = User::first();
    if(is_null($user)) return Inertia::render('SuperAdmin/createAdmin');
    else return Inertia::render('User/RegisterUser');
      })->name('register');

   // main mobile menu view route (via qr code)
   Route::get('/{restaurant_name}/menu/{restaurant_id}/{menu_id?}/{table_number?}',[App\Http\Controllers\Web\MobileMenu\MobileMenuController::class, 'getMainMenu'])->name('mobile menu');
   
   // mobile sub-menus route (via qr code)
   Route::get('/{restaurant_name}/sub-menu/{sub_menu_id}',[App\Http\Controllers\Web\MobileMenu\MobileMenuController::class, 'getSubMenus'])->name('mobile menu');
  
   // get main menus route
   Route::get('/{restaurant_name}/main-menu/{menu_id}',[App\Http\Controllers\Web\MobileMenu\MobileMenuController::class, 'getOneMainMenu'])->name('get main mobile menu');
   Route::get('/fetch/{restaurant_name}/main-menu/{menu_id}',[App\Http\Controllers\Web\MobileMenu\MobileMenuController::class, 'fetchMainMenu'])->name('fetch main mobile menu');
   
  
 // verify email route
    Route::get('/verify-email/{email}','Web\Auth\EmailVerificationController@verifyEmail');

// redict users after authentication
Route::get('/redirect/user','Web\Auth\AuthController@redirectUser')->middleware('auth');

//============ PROTECTED  All Users ROUTES ===================

Route::middleware(['auth', 'is_user'])->group(function () { 
    // route to dash board users will be redirected accordingly
    Route::get('/dashboard/{user_id}/{restaurant_id}', [App\Http\Controllers\Web\DashboardController::class, 'index']);
       
    //logout route
    Route::post('/logout','Web\Auth\AuthController@logout');
   
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    //menus route
    Route::get('/menus', [App\Http\Controllers\Web\Menu\MenuController::class, 'index'])->name('menus');

 
    Route::get('/sub-menu', [App\Http\Controllers\Web\SubMenu\SubMenuController::class, 'index'])->name('sub-menu');
    Route::get('/sub-menu/{id}', [App\Http\Controllers\Web\Menu\MenuController::class, 'show'])->name('sub-menu');
    Route::get('/menu-items', [App\Http\Controllers\Web\MenuItem\MenuItemController::class, 'index'])->name('menu-items');
    Route::get('/menu-items/{id}', [App\Http\Controllers\Web\SubMenu\SubMenuController::class, 'show'])->name('menu-item1');

    //Qr code routes
    Route::get('qr-scans-history/{restaurant_id}',[App\Http\Controllers\Web\QrCodeScans\QrCodeScansController::class, 'getRestaurantScans'])->name('single-restaurant-scans');
    Route::get('qrcode-get','QrCodeController@index')->name('qrcode-get');
    Route::get('qrcode-create','QrCodeController@create')->name('qrcode-create');
   
  
    // orders routes
    Route::get('/{restaurant_name}/orders/kitchen/{restaurant_id}', [App\Http\Controllers\Web\Order\OrderController::class, 'kitchenOrders'])->name('kitchen-orders');
    Route::get('/{restaurant_name}/orders/cashier/{restaurant_id}', [App\Http\Controllers\Web\Order\OrderController::class, 'cashierOrders'])->name('cashier-orders');
    Route::get('/{restaurant_name}/orders/delivery/{restaurant_id}', [App\Http\Controllers\Web\Order\OrderController::class, 'deliveryOrders'])->name('delivery-orders');
   
  
  // reports routes
    Route::get('/reports/summary', [App\Http\Controllers\Api\Report\ReportController::class, 'summaryReportsPage']);
    Route::get('/reports/custom', [App\Http\Controllers\Api\Report\ReportController::class, 'customReportsPage']);
    
    // --------------------------------------------------------------------------//
    //Subsciptions packages  page routes
    Route::get('subscription', [App\Http\Controllers\Web\Subscription\SubscriptionController::class, 'showSubscriptionsPackagesPage'])->name('show-packages');
  
  }); 

  //Protected routes shared but user/cashier/kitchen/delivery
  Route::middleware(['auth', 'is_user_cashier_kitchen_delivery'])->group(function () { 
      Route::get('/{restaurant_name}/orders/{restaurant_id}/refresh', [App\Http\Controllers\Web\Order\OrderController::class, 'refreshOrders'])->name('refresh-orders');
      Route::get('/orders/{restaurant_id}/{search_term}', [App\Http\Controllers\Web\Order\OrderController::class, 'fetchOrders']);
      Route::get('/orders/{restaurant_id}/type/{order_type}', [App\Http\Controllers\Web\Order\OrderController::class, 'fetchOrderTypes']);
      Route::get('/orders/{restaurant_id}/tables/{table_no}', [App\Http\Controllers\Web\Order\OrderController::class, 'fetchOrderTables']);
      Route::get('/orders/{restaurant_id}/date/{date}', [App\Http\Controllers\Web\Order\OrderController::class, 'fetchOrderBydate']);
      Route::get('/search-orders/{order_no}',[App\Http\Controllers\Web\Admin\OrdersController::class, 'searchOrderNo'])->name('search-order-no');
   }); 
  
// ---------------------------------------------------------------------------------

// cashier, kitchen and delivery independent routes
Route::get('/cashier', [App\Http\Controllers\Api\Cashier\CashierController::class, 'cashierPage'])->middleware('cashier');
Route::get('/kitchen', [App\Http\Controllers\Api\Kitchen\KitchenController::class, 'kitchenPage'])->middleware('kitchen');
Route::get('/delivery', [App\Http\Controllers\Api\Delivery\DeliveryController::class, 'deliveryPage'])->middleware('delivery');

// --------------------------------------------------------------------------------------

//=====================Protected SUPER ADMIN ROUTES ====================//
Route::middleware(['auth','admin'])->group(function () { 
    Route::get('all-admins',[App\Http\Controllers\Web\Admin\AdminController::class, 'allAdmins'])->name('all-admin');
    Route::get('admin',[App\Http\Controllers\Web\Admin\AdminController::class, 'index'])->name('super-admin');
    Route::get('admin/client-portal',[App\Http\Controllers\Web\Admin\AdminController::class, 'clientsPortal'])->name('super-admin');
    Route::get('/users/deleted',[App\Http\Controllers\Web\Admin\AdminController::class, 'getDeletedUsers'])->name('deleted-users');
    Route::get('admin/orders',[App\Http\Controllers\Web\Admin\OrdersController::class, 'getAllOrders'])->name('admin-orders');
    
    // Route::get('/search-orders/{order_no}',[App\Http\Controllers\Web\Admin\OrdersController::class, 'searchOrderNo'])->name('search-order-no');
    Route::get('/search-orders/transaction/{transaction_id}',[App\Http\Controllers\Web\Admin\OrdersController::class, 'searchTransactionId'])->name('search-transaction-id');
    Route::get('/search-orders/email/{email}',[App\Http\Controllers\Web\Admin\OrdersController::class, 'searchOrdersByResaturantEmail'])->name('search-ordersby-email');

  // Qr code scans route
    Route::get('/admin-qr-code-scans', [App\Http\Controllers\Web\Admin\QrCodeScansController::class, 'allScans'])->name('all-qr-code-scans');
  // Qr code scans search by name route route
    Route::get('/admin-qrscansearch/{restaurant_name}', [App\Http\Controllers\Web\Admin\QrCodeScansController::class, 'searchScansByName'])->name('all-scans-by-name');
  // Qr code scans search by email route route
    Route::get('/admin-qr-scansearch-email/{email}', [App\Http\Controllers\Web\Admin\QrCodeScansController::class, 'searchScansByEmail'])->name('all-scans-by-name');

  Route::get('/admin-subscription-reconciliation', [App\Http\Controllers\Web\Admin\SubscriptionReconciliationController::class, 'viewAllSubscriptionpayments'])->name('all-subscription-payments');
 
  });  
  
  // banking routes 
Route::get('/banking/','Api\Banking\BankingController@showBankingPage');

    //========================= Stripe checkout callback routes ======================
 // stripe succsess route
    Route::get('/payment-success',[App\Http\Controllers\Api\StripePay\StripePayController::class, 'successful'])->name('stripe-checkout-successful');
    // stripe cancel checkout route
    Route::get('/payment-fail',[App\Http\Controllers\Api\StripePay\StripePayController::class, 'failed'])->name('stripe-checkout-failed');
 
 // stripe order succsess route
    Route::get('order-payment-success',[App\Http\Controllers\Api\StripePay\OrderPaymentsController::class, 'successful'])->name('order-checkout-successful');
    // order cancel checkout route
    Route::get('/order-payment-fail/{restaurant_id}/{table_number}/{order_number}',[App\Http\Controllers\Api\StripePay\OrderPaymentsController::class, 'failed'])->name('order-checkout-failed');


Auth::routes([
    'register' => false,
    'verify' => true,
    ]); 


// falback route
Route::fallback(function() {
        return response()->json([
            'success'=> false,
            'message' => 'Route not found',
            ], 404);
});
 