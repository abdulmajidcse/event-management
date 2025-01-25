<?php

/**
 * All helper functions are defined here
 */

use App\Handlers\AuthHandler;
use App\Handlers\RequestHandler;
use App\Handlers\ResponseHandler;

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

if (!function_exists('response')) {
    /**
     * Get response instance
     * 
     * @return ResponseHandler
     */
    function response(): ResponseHandler
    {
        return ResponseHandler::load();
    }
}

if (!function_exists('request')) {
    /**
     * Get request instance
     * 
     * @return RequestHandler
     */
    function request(): RequestHandler
    {
        return new RequestHandler;
    }
}

if (!function_exists('redirect')) {
    /**
     * Redirect to another URL/page
     * 
     * @param string $url
     * @param bool $away
     * 
     * @return void
     */
    function redirect(string $url, bool $away = false): void
    {
        if ($away) {
            // external redirect
            header('Location: ' . $url);
            exit;
        }

        // internal redirect
        header('Location: ' . url($url));
        exit;
    }
}

if (!function_exists('old')) {
    /**
     * Old request data
     * 
     * @param string $name
     * @param ?string $default
     * 
     * @return void
     */
    function old(string $name, ?string $default = null): string|null
    {
        $oldData = [];

        if (!empty($_SESSION['invalid_request_data']['old_data'])) {
            // get request validation old data
            $oldData = $_SESSION['invalid_request_data']['old_data'] ?? [];
        }

        if ($name && !empty($oldData[$name])) {
            // existing old value
            return $oldData[$name];
        }

        // default value
        return $default;
    }
}

if (!function_exists('errors')) {
    /**
     * Old request data
     * 
     * @param ?string $name
     * 
     * @return array|string|null
     */
    function errors(?string $name = null): array|string|null
    {
        $errors = [];

        if (!empty($_SESSION['invalid_request_data']['errors'])) {
            // get reqeust data validation errors
            $errors = $_SESSION['invalid_request_data']['errors'] ?? [];
        }

        if ($name) {
            if (!empty($errors[$name])) {
                // single value
                return $errors[$name];
            }

            return null;
        }

        // array value
        return $errors;
    }
}

if (!function_exists('setStatusMessage')) {
    /**
     * set status message
     * 
     * @param string $message
     * @param string $type
     * 
     * @return void
     */
    function setStatusMessage(string $message, string $type = 'success'): void
    {
        $_SESSION['status_message'] = [
            'message' => $message,
            'type' => $type,
        ];
    }
}

if (!function_exists('getStatusMessage')) {
    /**
     * get status message
     * 
     * @return array
     */
    function getStatusMessage(): array
    {
        $data = [
            'message' => '',
            'type' => '',
        ];

        if (!empty($_SESSION['status_message']['message'])) {
            // get message
            $data['message'] = $_SESSION['status_message']['message'];
        }

        if (!empty($_SESSION['status_message']['type'])) {
            // get type
            $data['type'] = $_SESSION['status_message']['type'];
        }

        return $data;
    }
}

if (!function_exists('auth')) {
    /**
     * AuthHandler instance
     * 
     * @return AuthHandler
     */
    function auth(): AuthHandler
    {
        return AuthHandler::configure();
    }
}
