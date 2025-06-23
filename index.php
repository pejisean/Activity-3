<?php
    require_once BASE_PATH . '/handlers/mongodbChecker.handler.php';
    require_once BASE_PATH . '/handlers/postgreChecker.handler.php';

// Load .env variables
require_once BASE_PATH . '/bootstrap.php'; 
require_once BASE_PATH . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->load(); // Assuming bootstrap.php has the above code

// Now environment variables are loaded and accessible
echo 'Database host is: ' . getenv('PG_HOST');
try {
    $dotenv->load();

    // Validate required environment variables are set and not empty
    $dotenv->required([
        'PG_HOST',
        'PG_PORT',
        'PG_DB',
        'PG_USER',
        'PG_PASS',
        'MONGO_URI',
        'MONGO_DB',
    ])->notEmpty();

    echo "<h2>Environment variables loaded successfully!</h2>";

    // Display the environment variables for verification
    echo "<pre>";
    echo "Postgres Configuration:\n";
    echo "Host: " . $_ENV['PG_HOST'] . "\n";
    echo "Port: " . $_ENV['PG_PORT'] . "\n";
    echo "Database: " . $_ENV['PG_DB'] . "\n";
    echo "User: " . $_ENV['PG_USER'] . "\n";
    echo "Password: " . str_repeat('*', strlen($_ENV['PG_PASS'])) . "\n"; // mask password

    echo "\nMongoDB Configuration:\n";
    echo "URI: " . $_ENV['MONGO_URI'] . "\n";
    echo "Database: " . $_ENV['MONGO_DB'] . "\n";
    echo "</pre>";

} catch (Dotenv\Exception\InvalidPathException $e) {
    echo "Error: .env file not found at " . BASE_PATH . "<br>";
} catch (Dotenv\Exception\ValidationException $e) {
    echo "Environment variable validation failed: " . $e->getMessage() . "<br>";
} catch (Exception $e) {
    echo "An unexpected error occurred: " . $e->getMessage() . "<br>";
}
?>