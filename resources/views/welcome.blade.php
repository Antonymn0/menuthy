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
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">                     
                            
                        
                        <a href="/login" class="btn btn-lg btn-primary pr-4 pl-4 ml-2">Login</a>   or    
                        <a href="/register" class="btn btn-lg btn-warning ml-2">Register</a>
                        <br />                               
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

@endsection
