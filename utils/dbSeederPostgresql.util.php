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
        'database/users.model.sql',
        'database/projects.model.sql'
    ];

    foreach ($sqlFiles as $file) {
        echo "Applying schema from {$file}...\n";

        $sql = file_get_contents($file);
        if ($sql === false) {
            throw new RuntimeException("Could not read {$file}");
        }

        $pdo->exec($sql);
        echo "Schema applied successfully from {$file}\n";
    }

    // Seeding tables with static data
    echo "Seeding tables with static data...\n";

    // Define mapping of tables to their static data files (PHP files returning arrays)
    $seedFiles = [
        'user' => DUMMIES_PATH . 'user.staticDatas.php',
    ];

    // Loop over each table and seed data
    foreach ($seedFiles as $table => $seedFile) {
        echo "Seeding table: $table from $seedFile\n";

        if (!file_exists($seedFile)) {
            echo "Seed file $seedFile not found, skipping.\n";
            continue;
        }

        // Load static data array from seed file
        $data = require $seedFile;

        if (!is_array($data)) {
            echo "Seed file $seedFile did not return an array, skipping.\n";
            continue;
        }

        // // Optional: Clear existing data before seeding (comment out if not desired)
        // $pdo->exec("TRUNCATE TABLE public.\"$table\" RESTART IDENTITY CASCADE;");

        // if (empty($data)) {
        //     echo "No data to seed for table $table.\n";
        //     continue;
        // }

        // Prepare insert statement dynamically based on keys of first row
        $columns = array_keys($data[0]);
        $columnsList = implode(', ', array_map(fn($col) => "\"$col\"", $columns));
        $placeholders = implode(', ', array_map(fn($col) => ":$col", $columns));

        $insertSql = "INSERT INTO public.\"$table\" ($columnsList) VALUES ($placeholders)";
        $stmt = $pdo->prepare($insertSql);

        // Insert each row
        foreach ($data as $row) {
            // Bind values dynamically
            foreach ($row as $col => $val) {
                $stmt->bindValue(":$col", $val);
            }
            $stmt->execute();
        }

        echo "Seeded " . count($data) . " rows into $table.\n";
    }
?>