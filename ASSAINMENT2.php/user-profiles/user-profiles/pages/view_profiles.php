<?php
require '../includes/db.php';
require '../includes/header.php';

$stmt = $pdo->query("SELECT p.*, u.username FROM profiles p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC");
$profiles = $stmt->fetchAll();
?>

<h2>User Profiles</h2>

<?php foreach ($profiles as $profile): ?>
  <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
    <h3><?= htmlspecialchars($profile['full_name']) ?> (<?= htmlspecialchars($profile['username']) ?>)</h3>
    <p><?= nl2br(htmlspecialchars($profile['bio'])) ?></p>

    <?php if ($profile['profile_pic']): ?>
      <img src="../img/<?= htmlspecialchars($profile['profile_pic']) ?>" width="100" style="object-fit:cover; height:100px;">
    <?php endif; ?>

    <br>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] === $profile['user_id']): ?>
      <a href="edit_profile.php?id=<?= $profile['id'] ?>">Edit</a> |
      <a href="../process/delete_profile_process.php?id=<?= $profile['id'] ?>" onclick="return confirm('Delete your profile?')">Delete</a>
    <?php endif; ?>
  </div>
<?php endforeach; ?>

<?php include '../includes/footer.php'; ?>
