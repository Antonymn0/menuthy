<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
    *   Authenticate user login 
    */ 
    public function login(Request $request){

        $data = $request->all();
        $credentials = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:4'],
            ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = Auth::user();
            if($user->role == 'admin') return redirect()->intended('/admin');
            if($user->role == 'user') return redirect()->intended('/dashboard');
            if($user->role == 'kitchen') return redirect('/kitchen');
            if($user->role == 'cashier') return redirect('/cashier');
            if($user->role == 'delivery') return redirect('/delivery');
            else return('/dashboard');
        }  
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);  
    }

     /*  
     *  Logout user
     */
    public function logout(Request $request){
            Auth::logout();
            return redirect('/login');
    }
    
}
