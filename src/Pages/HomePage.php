<?php

namespace Abdulmajidcse\EventManagement\Pages;

class HomePage
{
    public function index()
    {
        header('Content-Type: application/json');

        return json_encode($_SERVER);
    }
}
