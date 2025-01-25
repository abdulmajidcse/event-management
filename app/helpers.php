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
    function config(string $key): mixed
    {
        // get application config value
        $config = require __DIR__ . '/../config/app.php';
        return $config[$key] ?? null;
    }
}

if (!function_exists('asset')) {
    // generate asset url
    function asset(string $path): string
    {
        // get asset url
        $assetUrl = config('asset_url') ?? '';

        return $assetUrl . $path;
    }
}

if (!function_exists('url')) {
    // generate url
    function url(string $uri): string
    {
        // get asset url
        $appUrl = config('url') ?? '';

        return $appUrl . $uri;
    }
}

if (!function_exists('currentUri')) {
    // generate currentUri
    function currentUri(): string
    {
        // get request uri
        $uri = str_replace('?' . $_SERVER["QUERY_STRING"], '', $_SERVER["REQUEST_URI"]);
        // get server script name
        $scriptName = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
        // remove script name from path as a uri
        $uri = str_replace($scriptName, '', $uri);

        return $uri;
    }
}
