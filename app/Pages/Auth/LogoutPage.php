<?php

namespace App\Pages\Auth;

class LogoutPage
{
    public function __construct()
    {
        auth()->middleware('auth');
    }

    /**
     * Logout page
     */
    public function logout()
    {
        auth()->logout();
        redirect('/login');
    }
}
