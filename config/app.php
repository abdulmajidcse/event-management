<?php

/**
 * This is the application configuration file
 */

return [
    'name' => 'Event Management',

    // set false in production
    'debug' => true,

    'url' => 'http://event-management.test',

    'asset_url' => 'http://event-management.test/assets',

    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'event_management',
        'username' => 'root',
        'password' => '',
    ]
];
