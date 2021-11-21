@extends('layouts.app')

@section('title', 'Log In |')

@section('content')

@if(session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
    </div>
@endif

<div class="container animate__animated animate__fadeIn">
    <div class="columns justify-content-center">
        <div class="column">
            <div class="card">
                <div class="card-header-title">LogIn</div>
                    <div class="card-content"> 
                        <form name="login" method="post" action="{{ route('auth.loginAuthenticate') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="field">
                                <label for="date">Username</label>
                                <br>
                                <input class="input" type="text" name="username" required placeholder="Username">
                                <br>
                                <span class="ajax" id="usedUsername"></span><br>
                            </div>
                            <div class="field">
                                <label for="date">Password</label>
                                <br>
                                <input class="input" type="password" id="password" required name="password" placeholder="Password">
                                <br><br>
                            </div>

                            <button type="submit" class="button is-primary hvr-glow" style="color: #030303" id="submitBtn">
                                <span class="icon">
                                    <i class="fi-xwsuxl-plus-solid"></i>
                                </span>
                                <b>Login</b>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>            
        

@endsection