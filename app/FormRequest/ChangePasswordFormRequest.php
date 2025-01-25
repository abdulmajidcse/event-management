<?php

namespace App\FormRequest;

use App\Queries\UserQuery;

class ChangePasswordFormRequest extends FormRequest
{
    /**
     * Validate request data
     */
    public function validate()
    {
        $data = $this->sanitizeData(request()->input(), ['email']);
        $errors = [];

        // current password field validation
        if (empty($data['current_password'])) {
            $errors['current_password'] = 'The current password field is required.';
        } else {
            $user = (new UserQuery)->getUserById(auth()->user()->id);

            if ($user && !password_verify($data['current_password'], $user->password)) {
                $errors['current_password'] = 'The password is incorrect.';
            }
        }

        // password field validation
        if (empty($data['password'])) {
            $errors['password'] = 'The new password field is required.';
        } else if (strlen($data['password']) < 8) {
            $errors['password'] = 'The new password field must be at least 8 letters.';
        } else if (strlen($data['password']) > 50) {
            $errors['password'] = 'The new password field must not be greater than 50 letters.';
        } else if (!preg_match('/[A-Z]/', $data['password'])) {
            $errors['password'] = 'The new password field must be contain at least one uppercase letter.';
        } else if (!preg_match('/[a-z]/', $data['password'])) {
            $errors['password'] = 'The new password field must be contain at least one lowercase letter.';
        } else if (!preg_match('/[0-9]/', $data['password'])) {
            $errors['password'] = 'The new password field must be contain at least one number.';
        } else if (!preg_match('/[\W_]/', $data['password'])) {
            $errors['password'] = 'The new password field must be contain at least one special character.';
        } else if ($data['password'] !== $data['password_confirmation']) {
            $errors['password'] = 'The new password field confirmation does not match.';
        }

        // password_confirmation field validation
        if (empty($data['password_confirmation'])) {
            $errors['password_confirmation'] = 'The password confirmation field is required.';
        }

        if (count($errors) > 0) {
            // invalid data
            $this->invalid($data, $errors);

            return redirect('/change-password');
        }

        return $data;
    }
}
