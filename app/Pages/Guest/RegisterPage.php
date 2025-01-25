<?php

namespace App\Pages\Guest;

use App\FormRequest\RegisterFormRequest;
use App\Queries\UserQuery;

class RegisterPage
{
    public function __construct()
    {
        auth()->middleware('guest');
    }

    /**
     * Register page
     */
    public function index()
    {
        return view('guest.register');
    }

    /**
     * Create a new account
     */
    public function store()
    {
        try {
            // validated data
            $data = (new RegisterFormRequest)->validate();
            // create new user account
            if ((new UserQuery)->createUser($data)) {
                // set success message
                setStatusMessage('You are registered successfully!');
                return redirect('/login');
            }

            // set error message
            setStatusMessage('Failed to create your account! Please, try again later.', 'error');
            return redirect('/register');
        } catch (\Throwable $th) {
            // set error message
            setStatusMessage('Something went wrong! Please, try again later.', 'error');
            return redirect('/register');
        }
    }
}
