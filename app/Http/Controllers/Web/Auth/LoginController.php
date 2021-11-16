<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
         
        $data = $request->all();
        $credentials = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:4'],
            ]);
        
        if(Auth::attempt($credentials)){
             $request->session()->regenerate();
             $user = Auth::user();

             return redirect()->intended('home');
        }  
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);  
       
    }
}
