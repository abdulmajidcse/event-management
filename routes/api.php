<?php

use App\Queries\EventQuery;
use App\Handlers\RouteHandler;

// route instance
$route = RouteHandler::load();

/**
 * Define the application routes here
 */

$route->get('/api/event-details', function () {
    // Specific event details api
    $id = intval(request()->query('id'));
    $event = (new EventQuery)->getEventById($id);

    echo response()->json($event ?: []);
    exit;
});
