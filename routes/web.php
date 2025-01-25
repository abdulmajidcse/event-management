<?php

use App\Handlers\RouteHandler;
use App\Pages\RegisterPage;
use App\Pages\HomePage;
use App\Pages\LoginPage;

// route instance
$route = RouteHandler::load();

/**
 * Define the application web routes here
 */

$route->get('/', [HomePage::class, 'index']);
$route->get('/register', [RegisterPage::class, 'index']);
$route->post('/register', [RegisterPage::class, 'store']);
$route->get('/login', [LoginPage::class, 'index']);
