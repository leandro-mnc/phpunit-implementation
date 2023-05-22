<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migration',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASSWORD'],
            'port' => $_ENV['DB_PORT'],
            'charset' => 'utf8mb4',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASSWORD'],
            'port' => $_ENV['DB_PORT'],
            'charset' => 'utf8mb4',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'name' => 'testing',
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASSWORD'],
            'port' => $_ENV['DB_PORT'],
            'charset' => 'utf8mb4',
        ]
    ],
    'version_order' => 'creation'
];
