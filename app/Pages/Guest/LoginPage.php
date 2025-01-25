<?php

namespace App\Pages\Guest;

use App\FormRequest\LoginFormRequest;

class LoginPage
{
    public function __construct()
    {
        auth()->middleware('guest');
    }

    /**
     * Login page
     */
    public function index()
    {
        return view('guest.login');
    }

    /**
     * Check for login
     */
    public function store()
    {
        try {
            $request = new LoginFormRequest;
            // validated data
            $data = $request->validate();
            // try to authenticate user account
            $request->authenticate($data);
        } catch (\Throwable $th) {
            print_r($th);
            exit;
            // set error message
            setStatusMessage('Something went wrong! Please, try again later.', 'error');
            return redirect('/login');
        }
    }
}
