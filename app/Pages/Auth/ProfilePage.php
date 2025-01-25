<?php

namespace App\Pages\Auth;

use App\Queries\UserQuery;
use App\FormRequest\ProfileFormRequest;

class ProfilePage
{
    public function __construct()
    {
        auth()->middleware('auth');
    }

    /**
     * Profile page
     */
    public function index()
    {
        return view('auth.profile');
    }

    /**
     * Update authenticated user profile
     */
    public function update()
    {
        try {
            // validated data
            $data = (new ProfileFormRequest)->validate();
            $data['id'] = auth()->user()->id;
            // create new user account
            if ((new UserQuery)->updateUser($data)) {
                // set success message
                setStatusMessage('Your profile updated successfully!');
            } else {
                // set error message
                setStatusMessage('Failed to update your profile! Please, try again later.', 'error');
            }
        } catch (\Throwable $th) {
            // set error message
            setStatusMessage('Something went wrong! Please, try again later.', 'error');
        }

        return redirect('/profile');
    }
}
