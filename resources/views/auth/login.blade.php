@extends('layouts.app')

@section('content')    

<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<style>
    body {


        font-family: Montserrat;
    }


    .login-block {
        width: 315px;
        max-width:95vw !important;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        border-top: 5px solid #ff656c;
        margin: 0 1rem;
    }



    .login-block input:active,
    .login-block input:focus {
        border: 1px solid #ff656c;
    }

    .login-block button, .button {
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

<div class="d-flex align-items-center justify-content-center mx-2">
<div class="card border shadow p-3" style="width:400px;">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1 class="text-danger text-center">Login</h1>
            <div class="form-group">
                <label for="email" class="">{{ __('E-Mail ') }}</label>   <br>             
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                    
                
                <div class="form-group">
                    <label for="password" class="t">{{ __('Password') }}</label>   <br>             
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            
                <div class="py-3">
                    <input class="  border" type="checkbox" name="remember" id="remember" >
                    <label class="" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                    
                
                <div class="form-group mx-auto">
                    <input type="submit" class="button btn" name="" id="" value="Login">
                     <a href="/register" class="my-2 button btn ">  Register  </a>
                    <br/>                    
                    <br/>                    
                        <a class="mt-3 text-dark w-100" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                     
               
                </div>       
        </form>
    </div>
</div>
@endsection
