<?php

use Abdulmajidcse\EventManagement\Pages\AboutPage;
use Abdulmajidcse\EventManagement\Pages\HomePage;
use Abdulmajidcse\EventManagement\RequestHandler;

/**
 * Application Routes handler
 * Don't modify this line
 */
$app = new RequestHandler();

/**
 * Define the application routes here
 */
$app->get('/', [HomePage::class, 'index']);
$app->get('/about', [AboutPage::class, 'index']);



// Don't modify this line
return $app;
