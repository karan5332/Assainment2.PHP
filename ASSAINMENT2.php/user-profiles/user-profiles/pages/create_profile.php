<?php
require '../includes/db.php';
require '../includes/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Create Your Profile</h2>

<form action="../process/create_profile_process.php" method="POST" enctype="multipart/form-data">
  <label> Name:</label><br>
  <input type="text" name="full_name" required><br><br>

  <label>Bio:</label><br>
  <textarea name="bio" rows="4" required></textarea><br><br>

  <label>Profile Picture:</label><br>
  <input type="file" name="profile_pic" accept="image/*"><br><br>

  <button type="submit" name="create">Save Profile</button>
</form>

<?php include '../includes/footer.php'; ?>
