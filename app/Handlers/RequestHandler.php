<?php

namespace App\Handlers;

use App\Interfaces\RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface
{
    /**
     * Get query param
     * @param string $key
     * @param mixed $default
     * 
     * @return mixed
     */
    public function query(string $key = null, mixed $default = null): mixed
    {
        if ($key) {
            // single data
            return $_GET[$key] ?? $default;
        }

        // all data
        return $_GET;
    }

    /**
     * Get form data
     * @param string $key
     * @param mixed $default
     * 
     * @return mixed
     */
    public function input(string $key = null, mixed $default = null): mixed
    {
        if ($key) {
            // single data
            return $_POST[$key] ?? $default;
        }

        // all data
        return $_POST;
    }

    /**
     * Get all request data
     * @param string $key
     * @param mixed $default
     * 
     * @return mixed
     */
    public function all(string $key = null, mixed $default = null): mixed
    {
        if ($key) {
            // single data
            return $_REQUEST[$key] ?? $default;
        }

        // all data
        return $_REQUEST;
    }

    /**
     * Detect ajax reqeust
     * 
     * @return bool
     */
    public function isAjax(): bool
    {
        // Detect if the request is an AJAX request
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            return strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';;
        }

        return false;
    }
}
