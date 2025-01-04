<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'digital_boards';
$username = 'root';
$password = '';

try {
    // Create a PDO instance for MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
