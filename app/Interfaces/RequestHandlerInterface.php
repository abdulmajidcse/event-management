<?php

namespace App\Interfaces;

interface RequestHandlerInterface
{
    // get query param
    public function query(string $key = null, mixed $default = null): mixed;

    // get form data
    public function input(string $key = null, mixed $default = null): mixed;

    // get all request data
    public function all(string $key = null, mixed $default = null): mixed;
}
