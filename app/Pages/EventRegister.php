<?php

namespace App\Pages;

use App\FormRequest\EventRegisterFormRequest;
use App\Queries\AttendeeQuery;
use App\Queries\EventQuery;

class EventRegister
{
    /**
     * Get specific event
     * Check event data
     */
    private function getSpecificEvent()
    {
        $id = intval(request()->query('id'));
        $event = (new EventQuery)->getEventById($id);

        // 404 page when event data not found
        if (!$event) {
            notFoundView();
            exit;
        }

        return $event;
    }

    /**
     * Validate Max Attendess
     * 
     * @param object $event
     */
    private function validateMaxAttendees(object $event)
    {
        if ($event->attendees_count >= $event->max_attendees) {
            // set error message
            setStatusMessage('You are not able to register this event. Because, this event reached max attendees! Thank you!', 'warning');
            return redirect('/event-details?id=' . $event->id);
        }
    }

    /**
     * Event register
     */
    public function form()
    {
        $data['event'] = $this->getSpecificEvent();
        $this->validateMaxAttendees($data['event']);

        return view('event-register', $data);
    }

    /**
     * Store event register data
     */
    public function store()
    {
        $event = $this->getSpecificEvent();
        $this->validateMaxAttendees($event);

        try {
            // validated data
            $data = (new EventRegisterFormRequest)->validate();
            $data['event_id'] = $event->id;

            // create new user account
            if ((new AttendeeQuery)->createAttendee($data)) {
                // set success message
                setStatusMessage('You are registered on this event successfully!');
                return redirect('/event-details?id=' . $event->id);
            }

            // set error message
            setStatusMessage('Failed to register on this event! Please, try again later.', 'error');
            return redirect(oldUri());
        } catch (\Throwable $th) {
            // set error message
            print_r($th);
            exit;
            setStatusMessage('Something went wrong! Please, try again later.', 'error');
            return redirect(oldUri());
        }
    }
}
