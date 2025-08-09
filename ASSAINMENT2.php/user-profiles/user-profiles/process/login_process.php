<?php
require '../includes/db.php';
session_start();

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Fetch user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Store user in session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email']
        ];
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        die("Invalid email or password.");
    }
} else {
    header("Location: ../pages/login.php");
    exit();
}
