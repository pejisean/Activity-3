<?php

declare(strict_types=1);
session_start();


// Enable error reporting for debugging (disable in production)
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once BASE_PATH . '/vendor/autoload.php';
require_once BASE_PATH . '/bootstrap.php';
require_once UTILS_PATH . 'envSetter.util.php';

// PostgreSQL config assumed set in $pgConfig
$dsn = "pgsql:host={$pgConfig['pg_host']};port={$pgConfig['pg_port']};dbname={$pgConfig['pg_db']}";

try {
    $pdo = new PDO($dsn, $pgConfig['pg_user'], $pgConfig['pg_pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    header('Location: index.php?error=' . urlencode('Database connection error.'));
    exit;
}

// Validate request method and inputs
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?error=' . urlencode('Invalid request method.'));
    exit;
}

if (empty($_POST['username']) || empty($_POST['password'])) {
    header('Location: index.php?error=' . urlencode('Please fill in both username and password.'));
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

// Log login attempt for debugging (remove in production)
error_log("Login attempt for username: {$username}");

try {
    $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE username = :username');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log('User fetched: ' . ($user ? 'YES' : 'NO'));

    if (!$user) {
        header('Location: index.php?error=' . urlencode('User does not exist.'));
        exit;
    }

    if (!password_verify($password, $user['password_hash'])) {
        header('Location: index.php?error=' . urlencode('Incorrect password.'));
        exit;
    }

    // Authentication successful
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $username;
    $_SESSION['token'] = bin2hex(random_bytes(32)); // CSRF/session token

    error_log("User {$username} authenticated successfully.");

    // Redirect to dashboard (add ?success=1 for debugging)
    header('Location: /pages/dashboard/index.php?success=1');
    exit;

} catch (PDOException $e) {
    error_log("Database query error: " . $e->getMessage());
    header('Location: index.php?error=' . urlencode('Server error. Please try again later.'));
    exit;
}
