<?php

namespace App\Pages;

use App\Queries\EventQuery;

class HomePage
{
    public function index()
    {
        $data['page'] = intval(request()->query('page', 1));
        $data['page'] = $data['page'] < 1 ? 1 : $data['page'];
        $data['perPage'] = intval(request()->query('per_page', 10));
        $data['perPage'] = $data['perPage'] < 1 ? 10 : $data['perPage'];
        $data['eventDate'] = e(filter_var(request()->query('event_date', ''), FILTER_SANITIZE_SPECIAL_CHARS));
        $data['search'] = e(filter_var(request()->query('search', ''), FILTER_SANITIZE_SPECIAL_CHARS));

        $eventData = (new EventQuery)->getAllEvent($data);
        $data['events'] = $eventData['events'];
        $data['totalPages'] = $eventData['totalPages'];

        return view('home', $data);
    }

    /**
     * Event details
     */
    public function eventDetails()
    {
        $id = intval(request()->query('id'));
        $data['event'] = (new EventQuery)->getEventById($id);

        // 404 page when event data not found or id empty
        if (!$data['event']) {
            notFoundView();
            exit;
        }

        return view('event-details', $data);
    }
}
