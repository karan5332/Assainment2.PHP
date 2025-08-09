<?php
require '../includes/db.php';
require '../includes/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Profile ID is missing.");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM profiles WHERE id = ?");
$stmt->execute([$id]);
$profile = $stmt->fetch();

if (!$profile || $profile['user_id'] != $_SESSION['user']['id']) {
    die("Unauthorized access.");
}
?>

<h2>Edit Profile</h2>

<form action="../process/update_profile_process.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $profile['id'] ?>">

  <label>Name:</label><br>
  <input type="text" name="full_name" value="<?= htmlspecialchars($profile['full_name']) ?>" required><br><br>

  <label>Bio:</label><br>
  <textarea name="bio" rows="4" required><?= htmlspecialchars($profile['bio']) ?></textarea><br><br>

  <label>Change Profile Picture (optional):</label><br>
  <input type="file" name="profile_pic"><br><br>

  <button type="submit" name="update">Update</button>
</form>

<?php include '../includes/footer.php'; ?>
