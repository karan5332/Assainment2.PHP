<?php
$host = '172.31.22.43';
$db   = 'Karandeep200626250';
$user = 'Karandeep200626250';
$pass = 'KkSDqWCzNj'; // default XAMPP password is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // Uncomment for testing
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
