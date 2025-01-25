<?php

namespace App\FormRequest;

class RegisterFormRequest extends FormRequest
{
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
        }

        // password field validation
        if (empty($data['password'])) {
            $errors['password'] = 'The password field is required.';
        } else if (strlen($data['password']) < 8) {
            $errors['password'] = 'The password field must be at least 8 letters.';
        } else if (strlen($data['password']) > 50) {
            $errors['password'] = 'The password field must not be greater than 50 letters.';
        } else if (!preg_match('/[A-Z]/', $data['password'])) {
            $errors['password'] = 'The password field must be contain at least one uppercase letter.';
        } else if (!preg_match('/[a-z]/', $data['password'])) {
            $errors['password'] = 'The password field must be contain at least one lowercase letter.';
        } else if (!preg_match('/[0-9]/', $data['password'])) {
            $errors['password'] = 'The password field must be contain at least one number.';
        } else if (!preg_match('/[\W_]/', $data['password'])) {
            $errors['password'] = 'The password field must be contain at least one special character.';
        } else if ($data['password'] !== $data['password_confirmation']) {
            $errors['password'] = 'The password field confirmation does not match.';
        }

        // password_confirmation field validation
        if (empty($data['password_confirmation'])) {
            $errors['password_confirmation'] = 'The password confirmation field is required.';
        }

        if (count($errors) > 0) {
            // invalid data
            $this->invalid($data, $errors);

            redirect('/register');
        }

        return $data;
    }
}
