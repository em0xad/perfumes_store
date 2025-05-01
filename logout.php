<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logout</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

  <!-- Custom CSS -->
  <link href="style.css" rel="stylesheet" />
</head>
<body style="background-color: var(--blanc);">

  <div class="container mt-5">
    <div class="alert alert-info text-center" role="alert" style="font-family: var(--font-base);">
      You have been logged out successfully.
    </div>

    <div class="text-center">
      <a href="login.php" class="btn" style="background-color: var(--stone); color: white; font-family: var(--font-base);">
        Back to Login
      </a>
    </div>
  </div>

</body>
</html>

