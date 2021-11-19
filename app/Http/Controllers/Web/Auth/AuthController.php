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


    // authenticate user login 
    public function login(Request $request){
         dd($Request);
        $data = $request->all();
        $credentials = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:4'],
            ]);
        
        if(Auth::attempt($credentials)){
             $request->session()->regenerate();
             $user = Auth::user();

             return redirect()->intended('/dashboard');
        }  
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);        
    }

    //redirect users
    public function redirectUser(){
        $user = Auth::user();

        //get restaurant associated with user
        $restaurant = Restaurant::Where('user_id', $user->id)->first();


        // if user has restaurant redirect to dashboard
        if($restaurant){
            return redirect()->intended('dashboard/'. $user->id . '/' . $restaurant->id);
        }

        // else redirect to register resaturant page
         return Inertia::render('Restaurant/Register', ['user_id' =>  $user->id]);
     }


    //logout user
    public function logout(Request $request){
            Auth::logout();
            return redirect('/login');
    }
}
