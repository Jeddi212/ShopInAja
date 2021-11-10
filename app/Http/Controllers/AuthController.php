<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signUp()  
    {  
        return view('auth.signUp');
    }

    public function ajaxPassword()
    {
        return view('auth.ajax.cekPassword');
    }
}
