<?php

namespace App\Pages\Auth;

use App\FormRequest\CsrfFormRequest;
use App\FormRequest\EventFormRequest;
use App\Queries\EventQuery;

class EventPage
{
    public function __construct()
    {
        auth()->middleware('auth');
    }

    /**
     * Event list page
     */
    public function index()
    {
        $data['page'] = intval(request()->query('page', 1));
        $data['page'] = $data['page'] < 1 ? 1 : $data['page'];
        $data['perPage'] = intval(request()->query('per_page', 10));
        $data['perPage'] = $data['perPage'] < 1 ? 10 : $data['perPage'];
        $data['sortBy'] = e(filter_var(request()->query('sort_by', 'latest'), FILTER_SANITIZE_SPECIAL_CHARS));
        $data['eventDate'] = e(filter_var(request()->query('event_date', ''), FILTER_SANITIZE_SPECIAL_CHARS));
        $data['search'] = e(filter_var(request()->query('search', ''), FILTER_SANITIZE_SPECIAL_CHARS));
        $data['userId'] = auth()->user()->id;

        $eventData = (new EventQuery)->getAllEvent($data);
        $data['events'] = $eventData['events'];
        $data['totalPages'] = $eventData['totalPages'];

        return view('auth.events.index', $data);
    }

    /**
     * Event create page
     */
    public function create()
    {
        /**
         * Only for skip isset check in view pge
         * Because same view use in create and edit page
         */
        $data['event'] = null;
        return view('auth.events.form', $data);
    }

    /**
     * Store event data
     */
    public function store()
    {
        try {
            // validated data
            $data = (new EventFormRequest)->validate();
            $data['user_id'] = auth()->user()->id;
            // create new user account
            if ((new EventQuery)->createEvent($data)) {
                // set success message
                setStatusMessage('Event created successfully!');
                return redirect('/events');
            }

            // set error message
            setStatusMessage('Failed to create event! Please, try again later.', 'error');
            return redirect('/events');
        } catch (\Throwable $th) {
            // set error message
            setStatusMessage('Something went wrong! Please, try again later.', 'error');
            return redirect('/events');
        }
    }

    /**
     * Get specific event
     * Check event data and permission
     */
    private function getSpecificEvent()
    {
        $id = intval(request()->query('id'));
        $event = (new EventQuery)->getEventById($id);

        // 404 page when event data not found or id empty
        if (!$id || !$event) {
            notFoundView();
            exit;
        } else if ($event && $event->user_id != auth()->user()->id) {
            // user don't have permission to other events
            setStatusMessage('You do not have permission to access this event.', 'error');
            redirect('/events');
            exit;
        }

        return $event;
    }

    /**
     * Show specific event data
     */
    public function show()
    {
        $data['event'] = $this->getSpecificEvent();
        $data['attendees'] = (new EventQuery)->getAllAttendees($data['event']->id);

        return view('auth.events.show', $data);
    }

    /**
     * Event edit page
     */
    public function edit()
    {
        $data['event'] = $this->getSpecificEvent();

        return view('auth.events.form', $data);
    }

    /**
     * Update event data
     */
    public function update()
    {
        $event = $this->getSpecificEvent();

        try {
            // validated data
            $data = (new EventFormRequest)->validate();
            $data['id'] = $event->id;

            // create new user account
            if ((new EventQuery)->updateEvent($data)) {
                // set success message
                setStatusMessage('Event updated successfully!');
                return redirect('/events');
            }

            // set error message
            setStatusMessage('Failed to update event! Please, try again later.', 'error');
            return redirect('/events');
        } catch (\Throwable $th) {
            // set error message
            setStatusMessage('Something went wrong! Please, try again later.', 'error');
            return redirect('/events');
        }
    }

    /**
     * Delete specific event data
     */
    public function delete()
    {
        try {
            // validate csrf token
            new CsrfFormRequest;

            $id = intval(request()->query('id'));
            if (!$id || !(new EventQuery)->getEventById($id)) {
                // 404 page when id or event not found
                return notFoundView();
            }

            // create new user account
            if ((new EventQuery)->deleteEvent($id)) {
                // set success message
                setStatusMessage('Event deleted successfully!');
                return redirect('/events');
            }

            // set error message
            setStatusMessage('Failed to delete event! Please, try again later.', 'error');
            return redirect('/events');
        } catch (\Throwable $th) {
            // set error message
            setStatusMessage('Something went wrong! Please, try again later.', 'error');
            return redirect('/events');
        }
    }

    /**
     * Download attendee CSV report
     */
    public function downloadAttendeeCsv()
    {
        // validate csrf token
        new CsrfFormRequest;

        $event = $this->getSpecificEvent();
        $attendees = (new EventQuery)->getAllAttendees($event->id);

        if (count($attendees) < 1) {
            // set warning message
            setStatusMessage('Failed to download attendee CSV report! Because, no attendee in this event. Thank you!', 'warning');
            return redirect(oldUri());
        }

        // Set the headers to force download
        header('Content-Type: text/csv');
        header("Content-Disposition: attachment;filename=events_{$event->id}_attendee_report.csv");

        // Open the outpur stream
        $output = fopen('php://output', 'w');
        // Output the column headings
        fputcsv($output, ['ID', 'Event ID', 'Name', 'Email', 'Address']);
        // Output the attendee data
        foreach ($attendees as $attendee) {
            fputcsv($output, [
                $attendee->id,
                $attendee->event_id,
                $attendee->name,
                $attendee->email,
                $attendee->address,
            ]);
        }

        fclose($output);
        exit;
    }
}
