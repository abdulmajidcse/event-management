<?php

use App\Handlers\RequestHandler;
use App\Pages\AboutPage;
use App\Pages\HomePage;

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
