<?php

/**
 * This is the application bootstrap file.
 * 
 * It loads application routes
 * And run the application
 *
 */
require __DIR__ . '/../vendor/autoload.php';


try {
    // load the application
    (require_once __DIR__ . '/../config/routes.php')->run();
} catch (\Throwable $th) {
    if (config('debug') == true) {
        // throw exception when debug enables
        throw new \Exception($th);
    } else {
        // only show server error page
        serverErrorView();
    }
}
