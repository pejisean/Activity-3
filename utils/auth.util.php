<?php
declare(strict_types=1);
session_start();

// Enable full error reporting for debugging (remove or disable in production)
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'bootstrap.php';
require_once UTILS_PATH . 'envSetter.util.php';

// PostgreSQL config assumed set in $pgConfig
$dsn = "pgsql:host={$pgConfig['pg_host']};port={$pgConfig['pg_port']};dbname={$pgConfig['pg_db']}";

try {
    $pdo = new PDO($dsn, $pgConfig['pg_user'], $pgConfig['pg_pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    // Log and display connection error
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection error. Please check logs.");
}

// Check request method and inputs
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method. Please submit the form.");
}

if (empty($_POST['username']) || empty($_POST['password'])) {
    die("Please fill in both username and password.");
}

$username = trim($_POST['username']);
$password = $_POST['password'];

// Debug: show received input (avoid printing password in real debug)
error_log("Login attempt for username: {$username}");

try {
    // Prepare and execute query
    $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE username = :username');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Debug: output fetched user data (without password_hash)
    error_log('User fetched: ' . ($user ? 'YES' : 'NO'));

    if (!$user) {
        die("Invalid username or password.");
    }

    // Verify password
    if (!password_verify($password, $user['password_hash'])) {
        die("Invalid username or password.");
    }

    // Authentication successful: create session token
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $username;
    $_SESSION['token'] = bin2hex(random_bytes(32)); // CSRF/session token

    // Debug: confirm session creation
    error_log("User {$username} authenticated successfully. Session started.");

    // Redirect to dashboard
    header('Location: /pages/dashboard/index.php');
    exit;

} catch (PDOException $e) {
    error_log("Database query error: " . $e->getMessage());
    die("Server error. Please try again later.");
}
