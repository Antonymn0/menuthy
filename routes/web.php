<?php

use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeEmail;
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

// redict users after authentication
Route::get('/redirect/user','Web\Auth\AuthController@redirectUser');
// route to dash board users will be redirected accordingly
 Route::get('/dashboard/{user_id}/{restaurant_id}', [App\Http\Controllers\Web\DashboardController::class, 'index']);

    // Auth routes
    Route::post('login','Web\Auth\AuthController@login')->name('admin-login');
    
    Route::post('/register-user','Api\User\UserController@store');
    Route::get('/login','Web\Auth\AuthController@showLoginForm')->name('login');

Route::middleware(['auth'])->group(function () { 
    // verify emai route
    Route::get('/verify-email/{email}','Web\Auth\EmailVerificationController@verifyEmail');
       
    //logout route
    Route::post('/logout','Web\Auth\AuthController@logout');
   
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    //
    Route::get('/menus', [App\Http\Controllers\Web\Menu\MenuController::class, 'index'])->name('menus');
 
    Route::get('/sub-menu', [App\Http\Controllers\Web\SubMenu\SubMenuController::class, 'index'])->name('sub-menu');
    Route::get('/sub-menu/{id}', [App\Http\Controllers\Web\Menu\MenuController::class, 'show'])->name('sub-menu');
    Route::get('/menu-items', [App\Http\Controllers\Web\MenuItem\MenuItemController::class, 'index'])->name('menu-items');
    Route::get('/menu-items/{id}', [App\Http\Controllers\Web\SubMenu\SubMenuController::class, 'show'])->name('menu-item1');

    //Qr code routes
    Route::get('qrcode-get','QrCodeController@index')->name('qrcode-get');
    Route::get('qrcode-create','QrCodeController@create')->name('qrcode-create');

    // mobile menu view routes
    Route::get('/{restaurant_name}/menu/{restaurant_id}',[App\Http\Controllers\Web\MobileMenu\MobileMenuController::class, 'showMainMenu'])->name('mobile menu');

});

Auth::routes(['verify' => true]);

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
 