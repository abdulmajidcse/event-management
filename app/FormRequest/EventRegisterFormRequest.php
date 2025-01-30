<?php

namespace App\FormRequest;

use App\Queries\AttendeeQuery;

class EventRegisterFormRequest extends FormRequest
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
        } else if ((new AttendeeQuery)->getAttendeeByEventAndEmail(intval(request()->query('id')), $data['email'])) {
            // Unique user email validation
            $errors['email'] = 'The email has already been registered in this event.';
        }

        // address field validation
        if (empty($data['address'])) {
            $errors['address'] = 'The address field is required.';
        } else if (strlen($data['address']) < 3) {
            $errors['address'] = 'The address field must be at least 3 letters.';
        } else if (strlen($data['address']) > 190) {
            $errors['address'] = 'The address field must not be greater than 190 letters.';
        }

        if (count($errors) > 0) {
            // invalid data
            $this->invalid($data, $errors);

            return redirect(oldUri());
        }

        return $data;
    }
}
