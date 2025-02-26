<?php
$host = getenv('DATABASE_HOST') ?: 'localhost';
$user = getenv('DATABASE_USER') ?: 'root';
$password = getenv('DATABASE_PASSWORD') ?: '';
$database = getenv('DATABASE_NAME') ?: 'anugrah_medika';

$database = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

echo "Database Connected Successfully";
?>