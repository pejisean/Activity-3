<?php
require_once UTILS_PATH . 'envSetter.util.php';
$host = getenv('PG_HOST');
$port = getenv('PG_PORT');
$username = getenv('PG_USER');
$password = getenv('PG_PASS');
$dbname = getenv('PG_DB');

$conn_string = "host=$host port=$port dbname=$dbname user=$username password=$password";

$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    echo "❌ Connection Failed: ", pg_last_error() . "  <br>";
    exit();
} else {
    echo "✔️ PostgreSQL Connection  <br>";
    pg_close($dbconn);
}