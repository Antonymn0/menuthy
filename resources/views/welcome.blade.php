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
                </div>
                <div class="">
                    <div class="text-center">                           
                        <a href="/login" class="btn px-2 btn-danger pr-4 pl-4 mr-2">Login</a>     or      
                        <a href="/register" class="btn px-2 btn-danger ml-2 px-3">Register</a>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

@endsection
