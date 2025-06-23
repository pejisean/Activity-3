<?php
    require_once BASE_PATH . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->load();

    // Distribute the data using array key
    $pgConfig = [
        'pg_host'   => $_ENV['PG_HOST'] ?? null,
        'pg_port'   => $_ENV['PG_PORT'] ?? null,
        'pg_db'     => $_ENV['PG_DB'] ?? null,
        'pg_user'   => $_ENV['PG_USER'] ?? null,
        'pg_pass'   => $_ENV['PG_PASS'] ?? null,
    ];

    $mongoConfig = [
        'mongo_uri' => $_ENV['MONGO_URI'] ?? null,
        'mongo_db'  => $_ENV['MONGO_DB'] ?? null,
    ]
?>