<?php

namespace App\FormRequest;

use App\Queries\UserQuery;

class ProfileFormRequest extends FormRequest
{
    /**
     * Validate request data
     */
    public function validate()
    {
        $data = $this->sanitizeData(request()->input(), ['email']);
        $errors = [];

        // name field validation
        if (empty($data['name'])) {
            $errors['name'] = 'The name field is required.';
        } else if (strlen($data['name']) < 3) {
            $errors['name'] = 'The name field must be at least 3 letters.';
        } else if (strlen($data['name']) > 190) {
            $errors['name'] = 'The name field must not be greater than 190 letters.';
        }

        // email field validation
        if (empty($data['email'])) {
            $errors['email'] = 'The email field is required.';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'The email field must be a valid email.';
        } else if (strlen($data['email']) > 190) {
            $errors['email'] = 'The email field must not be greater than 190 letters.';
        } else {
            $user = (new UserQuery)->getUserByEmail($data['email']);
            // Unique user email validation
            if ($user && $user->email != auth()->user()->email) {
                $errors['email'] = 'The email has already been taken.';
            }
        }

        if (count($errors) > 0) {
            // invalid data
            $this->invalid($data, $errors);

            return redirect('/profile');
        }

        return $data;
    }
}
