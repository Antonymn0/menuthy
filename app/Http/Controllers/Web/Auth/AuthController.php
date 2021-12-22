<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    // show login form
    public function showLoginForm(){
        return view('auth/login');
    }


    //redirect users
    public function redirectUser(){
        $user = Auth::user();

        //get restaurant associated with user
        $restaurant = Restaurant::Where('user_id', $user->id)->first();
   

        // if user has restaurant redirect to dashboard
        if(isset($restaurant)){
            return redirect()->intended('/dashboard');
        }

        // else redirect to register resaturant page
         return redirect('/');
     }

    //logout user
    public function logout(Request $request){
            Auth::logout();
            return redirect('/login');
    }
}
