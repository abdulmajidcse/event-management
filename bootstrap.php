<?php

use Abdulmajidcse\EventManagement\Pages\HomePage;
use Abdulmajidcse\EventManagement\RequestHandler;

$app = new RequestHandler();

$app->get('/', [HomePage::class, 'index']);

return $app;
