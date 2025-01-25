<?php

/**
 * This is pure PHP, no framework is used.
 * But I'm inspired by the Laravel framework.
 * 
 * This file is the entry point of the application.
 */

// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap the application and handle the request...
require_once __DIR__ . '/../bootstrap/app.php';
