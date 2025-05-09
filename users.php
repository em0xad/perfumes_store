<?php
session_start();
include __DIR__ . '/Database/db_connection.php';
$role = $_SESSION['role'] ?? null;
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$check_admin = mysqli_query($conn, "SELECT role FROM users WHERE id = $user_id LIMIT 1");
$row = mysqli_fetch_assoc($check_admin);
if (!$row || $row['role'] != 'admin') {
    echo "<div style='margin: 20px;'> لا تملك صلاحية الدخول إلى هذه الصفحة.</div>";
    exit();
}

// حذف مستخدم
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    if ($delete_id != $user_id) {
        mysqli_query($conn, "DELETE FROM users WHERE id = $delete_id");
        header("Location: users.php");
        exit();
    } else {
        echo "<script>alert(' لا يمكنك حذف حسابك كمشرف.');</script>";
    }
}

// إضافة مستخدم جديد
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // التحقق من الحقول
    if (empty($username) || empty($email) || empty($password) || empty($role)) {
        echo "<script>alert(' الرجاء تعبئة جميع الحقول.');</script>";
    } else {
        // تحقق من البريد الإلكتروني
        $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
        if (mysqli_num_rows($check_email) > 0) {
            echo "<script>alert(' البريد الإلكتروني مستخدم مسبقًا.');</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', '$role')");
            header("Location: users.php");
            exit();
        }
    }
}

$users = mysqli_query($conn, "SELECT id, username, email, role FROM users");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المستخدمين</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap');

        :root {
            --golden: rgb(210, 159, 19);
            --dusty-pink: rgb(221, 188, 176);
            --stone: rgb(51, 63, 72);
            --blanc: #f3efed;
        }

        body {
            background-color: var(--blanc);
            font-family: 'Tahoma', sans-serif;
        }
        .header-user {
            background-color: var(--stone);
            color: var(--blanc);
            padding: 1rem 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .table thead {
            background-color: var(--dusty-pink);
        }

        .btn-golden {
            background-color: var(--golden);
            color: white;
        }

        .btn-golden:hover {
            background-color: rgb(185, 140, 15);
        }

        .badge-admin {
            background-color: rgb(210, 100, 19);
        }

        .badge-user {
            background-color: var(--stone);
        }

        .form-container {
            background-color: white;
            padding: 1.5rem;
            border: 1px solid var(--dusty-pink);
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }

       
    </style>
</head>
<body>

      <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container" style="margin-left: 0 !important;">
      <a class="navbar-brand d-flex align-items-center justify-content-center" href="index.php" style="width: 81%; height: 100%;">
          <img src="images/logo/logo1.png" alt="Logo" class="me-2" style="max-width: 10%; height: auto; padding-bottom:0 px;margin-bottom:0 px;">
          <span style="color: #D29F13; font-weight: bold; font-family: 'Monsieur La Doulaise';">Emad Aaldl</span>
      </a>

      <button class="btn btn-outline-secondary " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
      ☰
      </button>

</nav>


    <!-- Side Nav  -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
      
      <div class="offcanvas-header">
        
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="close"></button>
      </div>
      
      <div class="offcanvas-body">
        <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
          <img src="images/logo/logo1.png" alt="Logo" style="height: 50px; width: auto;" class="me-2">
          <span style="color: #D29F13; font-weight: bold; font-family: 'Monsieur La Doulaise';">Emad Aaldl</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="index.php" class="nav-link text-dark">الرئيسية</a>
          </li>
          <?php if ($role === 'admin'): ?>
            <li><a href="users.php" class="nav-link text-dark"> إدارة المستخدمين</a></li>
          <?php endif; ?>
          <?php if ($role === 'admin'||$role==='user'): ?>
            <li><a href="products.php" class="nav-link text-dark"> إدارة المنتجات</a></li>
          <?php endif; ?>
        </ul>
        <hr>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="images/icon/user.svg" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>الحساب</strong>
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
            <?php if ($role): ?>
              <li><a class="dropdown-item" href="logout.php">تسجيل الخروج</a></li>
            <?php else: ?>
              <li><a class="dropdown-item" href="login.php">تسجيل الدخول</a></li>
              <li><a class="dropdown-item" href="register.php">إنشاء حساب</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  
<div class="container py-5">
    <div class="card shadow mb-4">
        <div class="header-user">
            <h4 class="mb-0">إضافة مستخدم</h4>
        </div>
        <div class="card-body">
            <form method="POST" class="form-container">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="username" class="form-control" placeholder="اسم المستخدم" required>
                    </div>
                    <div class="col-md-3">
                        <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني" required>
                    </div>
                    <div class="col-md-3">
                        <input type="password" name="password" class="form-control" placeholder="كلمة المرور" required>
                    </div>
                    <div class="col-md-3">
                        <select name="role" class="form-select" required>
                            <option value="">اختر الدور</option>
                            <option value="user">مستخدم</option>
                            <option value="admin">مشرف</option>
                        </select>
                    </div>
                    <div class="col-md-3 mx-auto">
                        <button type="submit" name="add_user" class="btn btn-golden w-100">إضافة</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="header-user">
            <h4 class="mb-0">قائمة المستخدمين</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>المعرف</th>
                        <th>اسم المستخدم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الدور</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($users)): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td>
                                <span class="badge <?= $user['role'] == 'admin' ? 'badge-admin' : 'badge-user' ?> text-white p-2">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($user['id'] != $user_id): ?>
                                    <a href="users.php?delete=<?= $user['id'] ?>" class="btn btn-sm btn-golden" onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">حذف</a>
                                <?php else: ?>
                                    <span class="text-muted">لا يمكن حذف نفسك</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
