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

Route::get('/', function () {
    return view('welcome');
});





Route::get('register', function () { 
     return Inertia::render('User/RegisterUser');
      })->name('register');

Route::get('/login', function () { 
     return Inertia::render('User/Login');
      })->name('login');


// Route::post('register', function () {  return "register"; })->name('register');



// redict users after authentication
Route::get('/redirect/user','Web\Auth\AuthController@redirectUser');

// route to dash board users will be redirected accordingly
 Route::get('/dashboard/{user_id}/{restaurant_id}', [App\Http\Controllers\Web\DashboardController::class, 'index']);


 

Route::middleware(['auth'])->group(function () { 
    // verify emai route
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

    // main mobile menu view route
    Route::get('/{restaurant_name}/menu/{restaurant_id}',[App\Http\Controllers\Web\MobileMenu\MobileMenuController::class, 'getMainMenu'])->name('mobile menu');
    
    // mobile sub-menus route
    Route::get('/{restaurant_name}/sub-menu/{sub_menu_id}',[App\Http\Controllers\Web\MobileMenu\MobileMenuController::class, 'getSubMenus'])->name('mobile menu');
    
    // orders routes
    Route::get('/{restaurant_name}/orders/{restaurant_id}', [App\Http\Controllers\Web\Order\OrderController::class, 'index'])->name('orders');
    Route::get('/{restaurant_name}/orders/{restaurant_id}/refresh', [App\Http\Controllers\Web\Order\OrderController::class, 'refreshOrders'])->name('refresh-orders');
    Route::get('/orders/{restaurant_id}/{search_term}', [App\Http\Controllers\Web\Order\OrderController::class, 'fetchOrders']);


});

Auth::routes([
    'register' => false,
    'verify' => true,
    ]); 

//test email route
 Route::get('test-email',function(){

     return new WelcomeEmail($user='first_name');
 });



Route::fallback(function() {
        return response()->json([
            'success'=> false,
            'message' => 'No such route found on this server',
            ], 404);
});
 