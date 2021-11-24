@extends('layouts.app')

@section('content')    

<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<style>
    body {
        background: url('http://i.imgur.com/Eor57Ae.jpg') no-repeat fixed center center;
        background-size: cover;
        font-family: Montserrat;
    }

    .logo {
        width: 213px;
        height: 36px;
        background: url('http://i.imgur.com/fd8Lcso.png') no-repeat;
        margin: 30px auto;
    }

    .login-block {
        width: 320px;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        border-top: 5px solid #ff656c;
        margin: 0 auto;
    }

    .login-block h1 {
        text-align: center;
        color: #000;
        font-size: 18px;
        text-transform: uppercase;
        margin-top: 0;
        margin-bottom: 20px;
    }

    .login-block input {
        width: 100%;
        height: 42px;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 14px;
        font-family: Montserrat;
        padding: 0 20px 0 50px;
        outline: none;
    }

    .login-block input#username {
        background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
        background-size: 16px 80px;
    }

    .login-block input#username:focus {
        background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
        background-size: 16px 80px;
    }

    .login-block input#password {
        background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
        background-size: 16px 80px;
    }

    .login-block input#password:focus {
        background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
        background-size: 16px 80px;
    }

    .login-block input:active,
    .login-block input:focus {
        border: 1px solid #ff656c;
    }

    .login-block button {
        width: 100%;
        height: 40px;
        background: #ff656c;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #e15960;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 14px;
        font-family: Montserrat;
        outline: none;
        cursor: pointer;
    }

    .login-block button:hover {
        background: #ff7b81;
    }
</style>


<div class="login-block border mt-3">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Login</h1>
            <div class="form-group">
                <label for="email" class="">{{ __('E-Mail Address') }}</label>                
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                    
                
                <div class="form-group">
                    <label for="password" class="t">{{ __('Password') }}</label>                
                    <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            
                <div class="py-2 d-flex align-content-center">
                    <input class="  border" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                    
                
                <div class="form-group">
                    <button type="submit" class="m-1">
                        {{ __('Login') }}
                    </button> 
                    <button> <a href="/register" class="my-2 mx-2">  Register </a></button>
                    <br/>                    
                    <br/>                    
                        <a class="mt-3 text-dark " href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                     
               
                </div>       
        </form>
    </div>

@endsection
