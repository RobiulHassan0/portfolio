<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function showLoginPage(){
        return view('auth.login');
    }
}
