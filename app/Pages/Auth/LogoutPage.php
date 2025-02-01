<?php

namespace App\Pages\Auth;

use App\FormRequest\CsrfFormRequest;

class LogoutPage
{
    public function __construct()
    {
        auth()->middleware('auth');
        new CsrfFormRequest;
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
