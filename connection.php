<?php
$host = getenv('DATABASE_HOST') ?: 'mysql.railway.internal';
$user = getenv('DATABASE_USER') ?: 'root';
$password = getenv('DATABASE_PASSWORD') ?: 'bfFcfJsnzrloHJOAWMUpBfMiZIpDlBOb';
$database = getenv('DATABASE_NAME') ?: 'railway';

$database = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

echo "Database Connected Successfully";
?>