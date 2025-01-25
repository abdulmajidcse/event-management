<?php

use App\Pages\HomePage;
use App\Handlers\RouteHandler;
use App\Pages\Guest\LoginPage;
use App\Pages\Auth\DashboardPage;
use App\Pages\Auth\LogoutPage;
use App\Pages\Auth\ProfilePage;
use App\Pages\Guest\RegisterPage;

// route instance
$route = RouteHandler::load();

/**
 * Define the application web routes here
 */

/**
 * Public routes
 */
$route->get('/', [HomePage::class, 'index']);

/**
 * Guest routes
 */
$route->get('/register', [RegisterPage::class, 'index']);
$route->post('/register', [RegisterPage::class, 'store']);
$route->get('/login', [LoginPage::class, 'index']);
$route->post('/login', [LoginPage::class, 'store']);

/**
 * Auth routes
 */
$route->get('/dashboard', [DashboardPage::class, 'index']);
$route->get('/profile', [ProfilePage::class, 'index']);
$route->post('/profile', [ProfilePage::class, 'update']);
$route->post('/logout', [LogoutPage::class, 'logout']);
