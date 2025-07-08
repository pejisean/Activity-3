<?php
declare(strict_types=1);
session_start();

require_once 'vendor/autoload.php';
require_once 'bootstrap.php';
require_once UTILS_PATH . 'envSetter.util.php';

// PostgreSQL config assumed set in $pgConfig
$dsn = "pgsql:host={$pgConfig['pg_host']};port={$pgConfig['pg_port']};dbname={$pgConfig['pg_db']}";
$pdo = new PDO($dsn, $pgConfig['pg_user'], $pgConfig['pg_pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// Check if POST data exists
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['username']) || empty($_POST['password'])) {
    header('Location: login.php?error=Please+fill+in+all+fields');
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

try {
    // Fetch user by username
    $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE username = :username');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // User not found
        header('Location: login.php?error=Invalid+username+or+password');
        exit;
    }

    // Verify password hash
    if (!password_verify($password, $user['password_hash'])) {
        header('Location: login.php?error=Invalid+username+or+password');
        exit;
    }

    // Authentication successful: create session token
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $username;
    $_SESSION['token'] = bin2hex(random_bytes(32)); // CSRF/session token

    // Redirect to protected dashboard page
    echo http_response_code(302);
    error_log("Redirecting user {$username} to /pages/dashboard/index.php");
    header('Location: /pages/dashboard/index.php');
    exit;


} catch (PDOException $e) {
    // Log error in real app, show generic error here
    header('Location: login.php?error=Server+error');
    exit;
}
