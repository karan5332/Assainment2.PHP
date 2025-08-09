<?php
require '../includes/db.php';
session_start();

if (!isset($_SESSION['user']) || !isset($_POST['create'])) {
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$full_name = trim($_POST['full_name']);
$bio = trim($_POST['bio']);
$profile_pic = null;

// Handle image upload
if (!empty($_FILES['profile_pic']['name'])) {
    $upload_dir = "../img/";
    $profile_pic = uniqid() . '_' . basename($_FILES["profile_pic"]["name"]);
    $target_file = $upload_dir . $profile_pic;
    $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($image_type, $allowed)) {
        die("Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        die("Image upload failed.");
    }
}

// Insert into DB
$stmt = $pdo->prepare("INSERT INTO profiles (user_id, full_name, bio, profile_pic) VALUES (?, ?, ?, ?)");
$stmt->execute([$user_id, $full_name, $bio, $profile_pic]);

header("Location: ../pages/dashboard.php");
exit();
