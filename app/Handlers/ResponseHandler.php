<?php

namespace App\Handlers;

use App\Interfaces\ResponseHandlerInterface;

class ResponseHandler implements ResponseHandlerInterface
{
    private static $instance;

    private function __construct() {}

    /**
     * get instance
     */
    public static function load(): self
    {
        if (!static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    /**
     * json data
     */
    public function json(mixed $data = [], int $statusCode = 200): mixed
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);

        return json_encode($data);
    }
}
