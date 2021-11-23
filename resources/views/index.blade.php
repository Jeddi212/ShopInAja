@extends('layouts.app')

@section('title', 'Hello |')

@section('content')

<div class="container animate__animated animate__fadeIn">
    <div class="columns justify-content-center">
        <div class="column">
            <div class="card">
                <div class="card-header-title"><h1>WELCOME GOOD PEOPLE</h1></div>
                    <div class="card-content"> 
                        <a class="button is-primary is-large hvr-glow" href="{{ url('/login') }}">
                            <span class="icon">
                                <i class="fi-xwsuxl-sign-in-solid"></i>
                            </span>
                            <b style="color: white;">Login</b>
                        </a>
                        <a class="button is-warning is-large hvr-glow" href="{{ url('/signup') }}">
                            <span class="icon">
                                <i class="fi-xnsuxl-user-plus-solid"></i>
                            </span>
                            <b style="color: white;">Register</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>            
        

@endsection