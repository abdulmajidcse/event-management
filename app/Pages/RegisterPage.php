<?php

namespace App\Pages;

use App\FormRequest\RegisterFormRequest;
use App\Queries\UserQuery;

class RegisterPage
{
    public function index()
    {
        return view('register');
    }

    public function store()
    {
        // validated data
        $data = (new RegisterFormRequest)->validate();
        // create new user account
        (new UserQuery)->createUser($data);
        // set success message
        setStatusMessage('You are registered successfully!');

        return redirect('/login');
    }
}
