<?php
// includes/db.php
require_once __DIR__ . '/config.php';

$conn = mysqli_init();
if (!$conn) {
    die("mysqli_init failed");
}

// Ensure database connection uses getenv() directly
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');
$db_port = getenv('DB_PORT');

// Secure file path moved to .env
$cert_file = getenv('SSL_CERT_PATH') ?: 'ca.pem';
$ssl_cert_path = dirname(__DIR__) . '/' . $cert_file;

// Configure SSL
mysqli_ssl_set($conn, NULL, NULL, $ssl_cert_path, NULL, NULL);

// Establish SSL connection using getenv values
if (!mysqli_real_connect($conn, $db_host, $db_user, $db_pass, $db_name, $db_port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Database Connection Failed: " . mysqli_connect_error());
}