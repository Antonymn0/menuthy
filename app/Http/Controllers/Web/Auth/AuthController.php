<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    //logout user
    public function logout(Request $request){
            Auth::logout();
            return redirect('/login');
    }
}
