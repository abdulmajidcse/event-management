<?php

namespace App\Pages\Auth;

class DashboardPage
{
    public function __construct()
    {
        auth()->middleware('auth');
    }
    
    /**
     * Dashboard page
     */
    public function index()
    {
        return view('auth.dashboard');
    }
}
