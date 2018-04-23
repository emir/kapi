<?php

return [
    'displayErrorDetails' => 'local' === getenv('APP_ENV'),
    'addContentLengthHeader' => false,
    'determineRouteBeforeAppMiddleware' => false,

    // Renderer settings
    'renderer' => [
        'template_path' => __DIR__ . '/../templates/',
    ],
    
    // Monolog settings
    'logger' => [
        'name' => getenv('APP_NAME'),
        'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/kapi.log',
        'level' => \Monolog\Logger::DEBUG,
    ],

    // Database settings
    'db' => [
        'driver' => getenv('DB_DRIVER'),
        'host' => getenv('DB_HOST'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'charset' => 'utf8',
        'port' => getenv('DB_PORT'),
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    ]
];
