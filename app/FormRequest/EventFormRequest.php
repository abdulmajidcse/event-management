<?php

namespace App\FormRequest;

use App\Queries\EventQuery;
use DateTime;

class EventFormRequest extends FormRequest
{
    /**
     * Validate request data
     */
    public function validate()
    {
        $data = $this->sanitizeData(request()->input());
        $errors = [];

        // title field validation
        if (empty($data['title'])) {
            $errors['title'] = 'The title field is required.';
        } else if (strlen($data['title']) < 3) {
            $errors['title'] = 'The title field must be at least 3 letters.';
        } else if (strlen($data['title']) > 190) {
            $errors['title'] = 'The title field must not be greater than 190 letters.';
        }

        // address field validation
        if (empty($data['address'])) {
            $errors['address'] = 'The address field is required.';
        } else if (strlen($data['address']) < 3) {
            $errors['address'] = 'The address field must be at least 3 letters.';
        } else if (strlen($data['address']) > 190) {
            $errors['address'] = 'The address field must not be greater than 190 letters.';
        }

        // description field validation
        if (empty($data['description'])) {
            $errors['description'] = 'The description field is required.';
        } else if (strlen($data['description']) < 3) {
            $errors['description'] = 'The description field must be at least 3 letters.';
        } else if (strlen($data['description']) > 5000) {
            $errors['description'] = 'The description field must not be greater than 5000 letters.';
        }

        // max_attendees field validation
        if (empty($data['max_attendees'])) {
            $errors['max_attendees'] = 'The max attendees field is required.';
        } else if (!filter_var($data['max_attendees'], FILTER_VALIDATE_INT)) {
            $errors['max_attendees'] = 'The max attendees field must be an integer.';
        } else if ($data['max_attendees'] < 1) {
            $errors['max_attendees'] = 'The max attendees field minimum 1.';
        } else if ($data['max_attendees'] > 1000) {
            $errors['max_attendees'] = 'The max attendees field must not be greater than 1000.';
        }

        // event_date field validation
        $eventDate = (new DateTime($data['event_date']))->format('Y-m-d');
        if (empty($data['event_date'])) {
            $errors['event_date'] = 'The event date field is required.';
        } else if ($eventDate !== $data['event_date']) {
            $errors['event_date'] = 'The event date field must be a date.';
        } else if (date('Y-m-d') > $data['event_date']) {
            $errors['event_date'] = 'The event date field must be today or future date.';
        }

        if (count($errors) > 0) {
            // invalid data
            $this->invalid($data, $errors);

            return redirect(oldUri());
        }

        return $data;
    }
}
