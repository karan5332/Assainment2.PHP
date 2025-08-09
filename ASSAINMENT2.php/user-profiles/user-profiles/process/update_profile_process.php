<?php
require '../includes/db.php';
session_start();

if (!isset($_SESSION['user']) || !isset($_POST['update'])) {
    header("Location: ../pages/login.php");
    exit();
}

$id = $_POST['id'];
$full_name = trim($_POST['full_name']);
$bio = trim($_POST['bio']);
$user_id = $_SESSION['user']['id'];

// Fetch existing profile
$stmt = $pdo->prepare("SELECT * FROM profiles WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);
$profile = $stmt->fetch();

if (!$profile) {
    die("Profile not found or access denied.");
}

// Handle optional new image
$profile_pic = $profile['profile_pic'];
if (!empty($_FILES['profile_pic']['name'])) {
    $upload_dir = "../img/";
    $new_pic = uniqid() . '_' . basename($_FILES["profile_pic"]["name"]);
    $target_file = $upload_dir . $new_pic;
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) {
        die("Invalid file type.");
    }

    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        if ($profile_pic && file_exists($upload_dir . $profile_pic)) {
            unlink($upload_dir . $profile_pic); // delete old image
        }
        $profile_pic = $new_pic;
    }
}

// Update record
$stmt = $pdo->prepare("UPDATE profiles SET full_name = ?, bio = ?, profile_pic = ? WHERE id = ? AND user_id = ?");
$stmt->execute([$full_name, $bio, $profile_pic, $id, $user_id]);

header("Location: ../pages/view_profiles.php");
exit();
