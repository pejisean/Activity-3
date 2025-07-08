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

// Drop old tables first
echo "Dropping old tables…\n";

$tablesToDrop = [
    'project_users',
    'tasks',
    'meeting',
    'projects'
];

foreach ($tablesToDrop as $table) {
    $pdo->exec("DROP TABLE IF EXISTS {$table} CASCADE;");
    echo "❌ Dropped {$table}\n";
}

// Migrate new tables
$modelFiles = [
    'database/projects.model.sql',
    'database/project_users.model.sql',
    'database/meeting.model.sql',
    'database/tasks.model.sql',
];

foreach ($modelFiles as $modelFile) {
    echo "📄 Applying schema from {$modelFile}…\n";

    $sql = file_get_contents($modelFile);
    if ($sql === false) {
        throw new RuntimeException("❌ Could not read {$modelFile}");
    }

    $pdo->exec($sql);
    echo "✅ Created from {$modelFile}\n";
}

echo "✅ PostgreSQL migration complete!\n";