<?php

if (!function_exists('view')) {
    function view(string $path, array $data = [])
    {
        extract($data);
        require __DIR__ . "/views/$path";
    }
}
