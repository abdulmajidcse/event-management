<?php

/**
 * This is pure PHP, no framework is used.
 * But I'm inspired by the Laravel framework.
 * 
 * This file is the entry point of the application.
 * It requires the Composer autoload file and the bootstrap file.
 * The bootstrap file returns the application instance.
 * You may define routes in the bootstrap file.
 * The application instance is then run.
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap.php';

$app->run();
