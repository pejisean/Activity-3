<?php
require_once UTILS_PATH . 'envSetter.util.php';
$host = getenv('PG_HOST') ?: 'host.docker.internal';
$port = getenv('PG_PORT') ?: '5555';
$username = getenv('PG_USER') ?: 'user';
$password = getenv('PG_PASS') ?: 'password';
$dbname = getenv('PG_DB') ?: 'weatherdatabase';

$conn_string = "host=$host port=$port dbname=$dbname user=$username password=$password";

$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    echo "❌ Connection Failed: ", pg_last_error() . "  <br>";
    exit();
} else {
    echo "✔️ PostgreSQL Connection  <br>";
    pg_close($dbconn);
}