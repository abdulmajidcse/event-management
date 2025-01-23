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
        extract($data);
        require __DIR__ . "/views/$path";
    }
}

if (!function_exists('notFoundView')) {
    function notFoundView(array $data = [])
    {
        return view('404.php', $data);
    }
}
