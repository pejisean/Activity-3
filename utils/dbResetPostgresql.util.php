<?php
    declare(strict_types=1);

    // 1) Composer autoload
    require 'vendor/autoload.php';

    // 2) Composer bootstrap
    require 'bootstrap.php';

    // 3) envSetter
    require_once UTILS_PATH . 'envSetter.util.php';

    // ——— Connecting to PostgreSQL ———
    $dsn = "pgsql:host={$pgConfig['pg_host']};port={$pgConfig['pg_port']};dbname={$pgConfig['pg_db']}";
    $pdo = new PDO($dsn, $pgConfig['pg_user'], $pgConfig['pg_pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // Listing SQL files
    $sqlFiles = [
        'database/meeting.model.sql',
        'database/project_users.model.sql',
        'database/tasks.model.sql',
    ];

    foreach ($sqlFiles as $file) {
        echo "Applying schema from {$file}...<br>";

        $sql = file_get_contents($file);
        if ($sql === false) {
            throw new RuntimeException("Could not read {$file}");
        }

        $pdo->exec($sql);
        echo "Schema applied successfully from {$file}<br>";
    }

    // Truncating tables
    $tables = ['meeting', 'project_users', 'tasks'];

    echo "Truncating tables…<br>";

    foreach ($tables as $table) {
        $pdo->exec("TRUNCATE TABLE public.\"$table\" RESTART IDENTITY CASCADE;");
        echo "Truncated table: $table<br>";
    }

    echo "Database reset completed successfully.<br>";
?>