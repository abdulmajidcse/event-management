<?php

use App\Application;

// disable debugging mode
if (config('debug') != true) {
    error_reporting(0);
    ini_set('display_errors', 'off');
}

try {
    // run the application
    Application::configure()->create();
} catch (\Throwable $th) {
    if (config('debug') == true) {
        // throw exception when debug enables
        throw new \Exception($th);
    } else {
        // only show server error page
        serverErrorView();
    }
}
