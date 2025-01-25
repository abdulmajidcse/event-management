<?php

use App\Handlers\RouteHandler;

// route instance
$route = RouteHandler::load();

/**
 * Define the application routes here
 */

$route->get('/api/greeting', function () {
    echo response()->json(['message' => 'Welcome!']);
});
