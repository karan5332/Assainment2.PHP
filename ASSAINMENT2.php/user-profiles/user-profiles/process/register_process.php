<?php
require '../includes/db.php';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic validation
    if (empty($username) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    // Check for existing username or email
    $check = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $check->execute([$username, $email]);

    if ($check->rowCount() > 0) {
        die("Username or email already taken.");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into DB
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashedPassword]);

    echo "Registration successful. <a href='../pages/login.php'>Login now</a>";
} else {
    header("Location: ../pages/register.php");
    exit();
}
