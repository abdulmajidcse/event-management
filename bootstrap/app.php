<?php

/**
 * This is the application bootstrap file.
 * 
 * It loads application routes
 * And run the application
 *
 */

use App\Handlers\RouteHandler;

require __DIR__ . '/../vendor/autoload.php';

// disable debugging mode
if (config('debug') != true) {
    error_reporting(0);
    ini_set('display_errors', 'off');
}

try {
    // load the application routes
    require_once __DIR__ . '/../routes/web.php';
    require_once __DIR__ . '/../routes/api.php';

    // run the application routes
    RouteHandler::load()->run();
} catch (\Throwable $th) {
    if (config('debug') == true) {
        // throw exception when debug enables
        throw new \Exception($th);
    } else {
        // only show server error page
        serverErrorView();
    }
}
