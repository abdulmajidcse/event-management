<?php

use App\Pages\HomePage;
use App\Handlers\RouteHandler;
use App\Pages\Auth\ChangePasswordPage;
use App\Pages\Guest\LoginPage;
use App\Pages\Auth\DashboardPage;
use App\Pages\Auth\EventPage;
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
$route->get('/change-password', [ChangePasswordPage::class, 'index']);
$route->post('/change-password', [ChangePasswordPage::class, 'changePassword']);
$route->post('/logout', [LogoutPage::class, 'logout']);

/**
 * Event routes
 */
$route->get('/events', [EventPage::class, 'index']);
$route->get('/events/show', [EventPage::class, 'show']);
$route->get('/events/create', [EventPage::class, 'create']);
$route->post('/events/store', [EventPage::class, 'store']);
$route->get('/events/edit', [EventPage::class, 'edit']);
$route->post('/events/update', [EventPage::class, 'update']);
$route->post('/events/delete', [EventPage::class, 'delete']);
