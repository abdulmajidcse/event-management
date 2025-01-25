<?php

namespace App\Interfaces;

interface ResponseHandlerInterface
{
    /**
     * get instance
     */
    public static function load(): self;

    /**
     * json data
     */
    public function json(mixed $data = [], int $statusCode = 200): mixed;
}
