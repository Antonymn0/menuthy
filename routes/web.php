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


// Auth routes
//  Route::get('/register','Api\User\UserController@store');
Route::post('/login','Web\Auth\LoginController@login');
Route::post('/register-user','Api\User\UserController@store');
// Route::post('/login','Api\User\UserController@store');

 Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

//
Route::get('/menus', [App\Http\Controllers\Web\Menu\MenuController::class, 'index'])->name('menus');
Route::get('/sub-menu', [App\Http\Controllers\Web\SubMenu\SubMenuController::class, 'index'])->name('sub-menu');
Route::get('/menu-items', [App\Http\Controllers\Web\MenuItem\MenuItemController::class, 'index'])->name('menu-items');
Route::get('/item', [App\Http\Controllers\Web\Item\ItemController::class, 'index'])->name('item');