<?php

namespace App\Pages;

class HomePage
{
    public function index()
    {
        return view('home', ['message' => 'Welcome', 'name' => 'Abdul Majid']);
    }
}
