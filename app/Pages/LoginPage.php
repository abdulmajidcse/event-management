<?php

namespace App\Pages;

class LoginPage
{
    public function index()
    {
        print_r(getStatusMessage());
        
        return view('login');
    }
}
