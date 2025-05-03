<?php 







?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="images/favicon/favicon.ico" type="image/x-icon">
    <title>product</title>
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="images/logo/logo1.png" alt="Logo" class="me-2" style="height: 50px; width: auto;">
      <span style="color: #D29F13; font-weight: bold;">Emad Aaldl</span>
    </a>

    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
       <img src="images/icon/menu.png" alt="Menu" style="height: 30px; width: auto;">
    </button>


    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">الرئيسية</a></li>
        <li class="nav-item"><a class="nav-link" href="#men-perfumes">عطور له</a></li>
        <li class="nav-item"><a class="nav-link" href="#women-perfumes">عطور لها</a></li>
        
        <?php if ($role === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="users.php">لوحة التحكم</a></li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if ($role): ?>
          <li class="nav-item"><a class="nav-link" href="logout.php">تسجيل الخروج</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">تسجيل الدخول</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">إنشاء حساب</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>




<!-- Footer -->
<footer>
    <div class="container">
      <p class="mb-0">© 2025 عطورات  <span style="font-family: 'Monsieur La Doulaise'">Emad  Aladel</span> - جميع الحقوق محفوظة</p>
    </div>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>