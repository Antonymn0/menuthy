@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card py-5">
                <div class="container py-5 text-center">
                    <h2>
                        Menuthy digital menu
                    </h2>
                    <h6>
                        Serve Inovitavely
                    </h6>
                </div>z
                

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-sm btn-primary mr-2">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </button> or
                        <a href="/register" class="btn brn-sm btn-warning ml-2">Register</a>
                        <br />                               
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

@endsection
