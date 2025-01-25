<?php

use App\Handlers\RequestHandler;
use App\Pages\RegisterPage;
use App\Pages\HomePage;
use App\Pages\LoginPage;

/**
 * Application Routes handler
 * Don't modify this line
 */
$app = new RequestHandler();

/**
 * Define the application routes here
 */
$app->get('/', [HomePage::class, 'index']);
$app->get('/register', [RegisterPage::class, 'index']);
$app->post('/register', [RegisterPage::class, 'store']);
$app->get('/login', [LoginPage::class, 'index']);



// Don't modify this line
return $app;
