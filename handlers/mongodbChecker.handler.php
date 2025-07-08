<?php
require_once UTILS_PATH . 'envSetter.util.php';
// Fetch environment variables with defaults
$mongoHost = getenv('MONGO_HOST');
$mongoPort = getenv('MONGO_PORT');
$mongoUser = getenv('MONGO_USER');
$mongoPass = getenv('MONGO_PASS');
$mongoUri = getenv('MONGO_URI');
$mongoDb  = getenv('MONGO_DB');

try {
    $mongo = new MongoDB\Driver\Manager($mongoUri);

    // Ping command to test connection
    $command = new MongoDB\Driver\Command(["ping" => 1]);
    $mongo->executeCommand($mongoDb, $command);

    echo "✅ Connected to MongoDB successfully. <br>";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "❌ MongoDB connection failed: " . $e->getMessage() . "<br>";
}