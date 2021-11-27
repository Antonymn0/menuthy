<?php

use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeEmail;

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

/////////// PUBLIC ROUTES  ///////////////
Route::get('/', function () {
    return view('welcome');
});

   // main mobile menu view route (via qr code)
   Route::get('/{restaurant_name}/menu/{restaurant_id}/{menu_id?}/{table_number?}',[App\Http\Controllers\Web\MobileMenu\MobileMenuController::class, 'getMainMenu'])->name('mobile menu');
   
   // mobile sub-menus route (via qr code)
   Route::get('/{restaurant_name}/sub-menu/{sub_menu_id}',[App\Http\Controllers\Web\MobileMenu\MobileMenuController::class, 'getSubMenus'])->name('mobile menu');
   
   // show vuejs user register form
   Route::get('register', function () { 
     return Inertia::render('User/RegisterUser');
      })->name('register');


/////////// PROTECTED ROUTES /////
Route::middleware(['auth'])->group(function () { 
    // route to dash board users will be redirected accordingly
    Route::get('/dashboard/{user_id}/{restaurant_id}', [App\Http\Controllers\Web\DashboardController::class, 'index']);
    // redict users after authentication
    Route::get('/redirect/user','Web\Auth\AuthController@redirectUser');

    // verify email route
    Route::get('/verify-email/{email}','Web\Auth\EmailVerificationController@verifyEmail');
       
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
    Route::get('qrcode-get','QrCodeController@index')->name('qrcode-get');
    Route::get('qrcode-create','QrCodeController@create')->name('qrcode-create');
    
    // orders routes
    Route::get('/{restaurant_name}/orders/{restaurant_id}', [App\Http\Controllers\Web\Order\OrderController::class, 'index'])->name('orders');
    Route::get('/{restaurant_name}/orders/{restaurant_id}/refresh', [App\Http\Controllers\Web\Order\OrderController::class, 'refreshOrders'])->name('refresh-orders');
    Route::get('/orders/{restaurant_id}/{search_term}', [App\Http\Controllers\Web\Order\OrderController::class, 'fetchOrders']);

});


//-------------------------------SUPER ADMIN ROUTES -------------------------- //////

    Route::get('admin',[App\Http\Controllers\Web\Admin\AdminController::class, 'index'])->name('super-admin');
    Route::get('admin/client-portal',[App\Http\Controllers\Web\Admin\AdminController::class, 'clientsPortal'])->name('super-admin');
    
    




Auth::routes([
    'register' => false,
    'verify' => true,
    ]); 


// falback route
Route::fallback(function() {
        return response()->json([
            'success'=> false,
            'message' => 'Page not found',
            ], 404);
});
 