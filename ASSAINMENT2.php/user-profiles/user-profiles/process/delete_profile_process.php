<?php
require '../includes/db.php';
session_start();

if (!isset($_SESSION['user']) || !isset($_GET['id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user']['id'];

// Fetch profile to delete image
$stmt = $pdo->prepare("SELECT * FROM profiles WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);
$profile = $stmt->fetch();

if (!$profile) {
    die("Unauthorized or profile not found.");
}

if ($profile['profile_pic'] && file_exists("../img/" . $profile['profile_pic'])) {
    unlink("../img/" . $profile['profile_pic']);
}

$stmt = $pdo->prepare("DELETE FROM profiles WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);

header("Location: ../pages/view_profiles.php");
exit();
