<?php include '../includes/header.php'; ?>

<h2>User Registration</h2>

<form action="../process/register_process.php" method="POST">
  <label>Username:</label><br>
  <input type="text" name="username" required><br><br>

  <label>Email:</label><br>
  <input type="email" name="email" required><br><br>

  <label>Password:</label><br>
  <input type="password" name="password" required><br><br>

  <button type="submit" name="register">Register</button>
</form>

<p>Already having an account? <a href="login.php">Login here</a>.</p>

<?php include '../includes/footer.php'; ?>
