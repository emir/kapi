<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->load();

$config = require __DIR__ . '/src/config.php';

return [
    'paths' => [
        'migrations' => 'migrations'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => $config['db']['driver'],
            'host' => $config['db']['host'],
            'name' => $config['db']['database'],
            'user' => $config['db']['username'],
            'pass' => $config['db']['password'],
            'port' => $config['db']['port'],
        ]
    ]
];
