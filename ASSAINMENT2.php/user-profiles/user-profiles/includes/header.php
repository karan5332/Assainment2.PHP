<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profiles</title>
  <link rel="stylesheet" href="/user-profiles/css/style.css">
</head>
<body>
  <header>
    <h1>User Profile System</h1>
    <nav>
      <a href="/user-profiles/pages/home.php">Home</a> |
      <a href="/user-profiles/pages/view_profiles.php">View Profiles</a> |
      <?php if (isset($_SESSION['user'])): ?>
        <a href="/user-profiles/pages/dashboard.php">Dashboard</a> |
        <a href="/user-profiles/process/logout.php">Logout</a>|
      <?php else: ?>
        <a href="/user-profiles/pages/login.php">Login</a> |
        <a href="/user-profiles/pages/register.php">Register</a>|
      <?php endif; ?>
    </nav>
    <hr>
  </header>
  <main>
