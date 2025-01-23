<?php

/**
 * All helper functions are defined here
 */

/**
 * Load a view file
 * 
 * @param string $path
 * @param array $data
 * 
 * @return void
 */
if (!function_exists('view')) {
    function view(string $path, array $data = [])
    {
        // extract data for view file
        extract($data);
        // get view file location
        $path = str_replace('.', '/', $path);
        // load view file
        require __DIR__ . sprintf("/../views/%s.php", $path);
    }
}

if (!function_exists('notFoundView')) {
    function notFoundView(array $data = [])
    {
        http_response_code(404);
        // default 404 view
        return view('errors.404', $data);
    }
}

if (!function_exists('serverErrorView')) {
    function serverErrorView(array $data = [])
    {
        http_response_code(500);
        // default 500 view
        return view('errors.500', $data);
    }
}

if (!function_exists('config')) {
    function config(string $key): ?string
    {
        // get application config value
        $config = require __DIR__ . '/../config/app.php';
        return $config[$key] ?? null;
    }
}
