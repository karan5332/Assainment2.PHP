<?php
require '../includes/db.php';
require '../includes/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</h2>

<p>Here’s your dashboard. You can create a new profile below or view and update your existing profile.
</p>

<a href="create_profile.php"> Create Profile</a> 
<a href="view_profiles.php">View  Profiles</a>

<?php include '../includes/footer.php'; ?>
