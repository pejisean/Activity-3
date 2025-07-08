<?php
     require_once BASE_PATH . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->safeLoad();

    //populating getenv()
    foreach ($_ENV as $key => $value) {
    putenv("$key=$value");
    }

    // Distribute the data using array key
    $pgConfig = [
        'pg_host'   => $_ENV['PG_HOST'],
        'pg_port'   => $_ENV['PG_PORT'],
        'pg_db'     => $_ENV['PG_DB'],
        'pg_user'   => $_ENV['PG_USER'],
        'pg_pass'   => $_ENV['PG_PASS'],
    ];

    $mongoConfig = [
        'mongo_uri' => $_ENV['MONGO_URI'],
        'mongo_db'  => $_ENV['MONGO_DB'],
    ]
?>