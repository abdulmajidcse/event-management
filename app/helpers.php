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
        // default 404 view
        return view('errors.404', $data);
    }
}
