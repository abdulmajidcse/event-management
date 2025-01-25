<?php

namespace App\FormRequest;

use App\Handlers\AuthHandler;
use App\Queries\UserQuery;

class LoginFormRequest extends FormRequest
{
    /**
     * Validate request data
     */
    public function validate()
    {
        $data = $this->sanitizeData(request()->input(), ['email']);
        $errors = [];

        // email field validation
        if (empty($data['email'])) {
            $errors['email'] = 'The email field is required.';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'The email field must be a valid email.';
        }

        // password field validation
        if (empty($data['password'])) {
            $errors['password'] = 'The password field is required.';
        }

        if (count($errors) > 0) {
            // invalid data
            $this->invalid($data, $errors);
            return redirect('/login');
        }

        return $data;
    }

    /**
     * Authenticate user account
     */
    public function authenticate(array $data)
    {
        $user = (new UserQuery)->getUserByEmail($data['email']);

        if ($user && password_verify($data['password'], $user->password)) {
            // set auth session
            AuthHandler::configure()->attempt($user);
            return redirect('/dashboard');
        }

        // invalid data
        $errors = ['email' => 'These credentials do not match our records.'];
        $this->invalid($data, $errors);
        return redirect('/login');
    }
}
