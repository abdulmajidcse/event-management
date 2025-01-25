<?php

namespace App\Pages;

class RegisterPage
{
    public function index()
    {
        return view('register');
    }

    public function store()
    {
        echo response()->json(request()->input());
    }
}
