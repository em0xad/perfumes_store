<?php
session_start();
require 'db_connection.php';

$errors = [];
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "عنوان البريد الإلكتروني غير صالح.";
    }
    if (empty($password)) {
        $errors[] = "كلمة المرور مطلوبة.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare(
            "SELECT id, username, password, role FROM users WHERE email = ?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $username, $hashed, $role);
            $stmt->fetch();
            if (password_verify($password, $hashed)) {
                // تخزين البيانات في الجلسة
                $_SESSION["user_id"]   = $id;
                $_SESSION["username"]  = $username;
                $_SESSION["role"]      = $role;

                header("Location: index.php");
                exit;
            } else {
                $errors[] = "كلمة المرور غير صحيحة.";
            }
        } else {
            $errors[] = "البريد الإلكتروني غير موجود.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
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
  <h2 class="text-center mb-4" style="font-family: var(--font-heading);">تسجيل الدخول</h2>
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
  <form method="POST" action="login.php">
    <div class="mb-3">
      <label for="email" class="form-label" style="font-family: var(--font-base);">عنوان البريد الإلكتروني</label>
      <input type="email" class="form-control" id="email" name="email"
             value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label" style="font-family: var(--font-base);">كلمة المرور</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <button type="submit" class="btn w-100" style="background-color: var(--stone); color: white;">تسجيل الدخول</button>
  </form>

  <p class="text-center mt-3" style="font-family: var(--font-base);">
    ليس لديك حساب؟ <a href="register.php" style="color: var(--golden);">سجل هنا</a>
  </p>
</div>

</body>
</html>
