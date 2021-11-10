<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn()  
    {  
        return view('auth.signIn');
    }

    public function ajaxPassword()
    {
        return view('auth.ajax.cekPassword');
    }
}
