<?php

namespace App\Pages\Auth;

use App\FormRequest\ChangePasswordFormRequest;
use App\Queries\UserQuery;

class ChangePasswordPage
{
    public function __construct()
    {
        auth()->middleware('auth');
    }

    /**
     * Chnage password page
     */
    public function index()
    {
        return view('auth.change-password');
    }

    /**
     * change authenticated user password
     */
    public function changePassword()
    {
        try {
            // validated data
            $data = (new ChangePasswordFormRequest)->validate();
            $data['id'] = auth()->user()->id;
            // create new user account
            if ((new UserQuery)->updatePassword($data)) {
                // set success message
                setStatusMessage('Your password changed successfully!');
            } else {
                // set error message
                setStatusMessage('Failed to change your password! Please, try again later.', 'error');
            }
        } catch (\Throwable $th) {
            // set error message
            setStatusMessage('Something went wrong! Please, try again later.', 'error');
        }

        return redirect('/change-password');
    }
}
