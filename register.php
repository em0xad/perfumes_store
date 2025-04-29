<?php
session_start();
require 'db_connection.php';

$errors = [];
$username = '';
$email = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    
    if (empty($username)) {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }
    
    // تحقق من أن البريد غير مستخدم
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Email is already registered.";
        }
        $stmt->close();
    }

    // إذا لا يوجد أخطاء، قم بإدخال البيانات
    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed);
        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $errors[] = "Something went wrong, please try again.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Account</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Custom CSS File -->
    <link href="style.css" rel="stylesheet">
</head>
<body style="background-color: var(--blanc);">

<div class="container mt-5" style="max-width: 500px;">
  <h2 class="text-center mb-4" style="font-family: var(--font-heading);">Create New Account</h2>

  <br>
  <?php if (!empty($errors)): ?>
  <div class="alert alert-danger">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
  <br>

  <form method="POST" action="register.php">
    <div class="mb-3">
      <label for="username" class="form-label" style="font-family: var(--font-base);">Username</label>
      <input type="text" class="form-control" id="username" name="username"
             value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label" style="font-family: var(--font-base);">Email Address</label>
      <input type="email" class="form-control" id="email" name="email"
             value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label" style="font-family: var(--font-base);">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
      <div class="form-text">At least 6 characters.</div>
    </div>

    <div class="mb-3">
      <label for="confirm_password" class="form-label" style="font-family: var(--font-base);">Confirm Password</label>
      <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
    </div>

    <button type="submit" class="btn w-100" style="background-color: var(--stone); color: white;">Create Account</button>
  </form>

  <p class="text-center mt-3" style="font-family: var(--font-base);">
    Already have an account? <a href="login.php" style="color: var(--golden);">Login here</a>
  </p>
</div>

</body>
</html>
