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
        require __DIR__ . sprintf("/../views/%s.view.php", $path);
    }
}

if (!function_exists('notFoundView')) {
    function notFoundView(array $data = [])
    {
        if (request()->isAjax()) {
            echo response()->json(['message' => 'Not found.'], 422);
        } else {
            http_response_code(404);
            // default 404 view
            view('errors.404', $data);
        }

        exit;
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

        return $assetUrl . $path . '?v=1.0.0';
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
        $queryString = !empty($_SERVER["QUERY_STRING"]) ? ('?' . $_SERVER["QUERY_STRING"]) : '?';
        $uri = str_replace($queryString, '', $_SERVER["REQUEST_URI"]);
        // get server script name
        $scriptName = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
        // remove script name from path as a uri
        $uri = str_replace($scriptName, '', $uri);

        return $uri;
    }
}

if (!function_exists('oldUri')) {
    /**
     * Get old uri
     * 
     * @return string
     */
    function oldUri(): string
    {
        return !empty($_SESSION['old_uri']) ? $_SESSION['old_uri'] : '/';
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
        $value = $default;

        if (!empty($_SESSION['invalid_request_data']['old_data'])) {
            // get request validation old data
            $oldData = $_SESSION['invalid_request_data']['old_data'] ?? [];
        }

        if ($name && !empty($oldData[$name])) {
            // existing old value
            $value = $oldData[$name];
        }

        return $value ? e($value) : $value;
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

if (!function_exists('e')) {
    /**
     * Escape value to prevent XSS attack
     * 
     * @param string $text
     * @return string
     */
    function e(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('getCsrfToken')) {
    /**
     * Get CSRF token
     * 
     * @return string
     */
    function getCsrfToken(): string
    {
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('validateCsrfToken')) {
    /**
     * Validate CSRF token
     * 
     * @return bool
     */
    function validateCsrfToken(?string $token): bool
    {
        return hash_equals($_SESSION['csrf_token'], $token ?? '');
    }
}
