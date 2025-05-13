<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Your MySQL username
define('DB_PASS', ''); // Your MySQL password
define('DB_NAME', 'courseware_db');

// Establish database connection
try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

// User roles
define('ROLE_ADMIN', 1);
define('ROLE_FACULTY', 2);
define('ROLE_STUDENT', 3);
?>