<?php

/**
 * This is the application bootstrap file.
 * 
 * It loads application routes
 * And run the application
 *
 */
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../config/routes.php';

$app->run();
