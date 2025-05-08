<?php
session_start();
include __DIR__ . '/Database/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$check_admin = mysqli_query($conn, "SELECT role FROM users WHERE id = $user_id LIMIT 1");
$row = mysqli_fetch_assoc($check_admin);
if (!$row || $row['role'] != 'admin') {
    echo "<div style='margin: 20px;'>🚫 لا تملك صلاحية الدخول إلى هذه الصفحة.</div>";
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
        echo "<script>alert('❌ لا يمكنك حذف حسابك كمشرف.');</script>";
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
        echo "<script>alert('⚠️ الرجاء تعبئة جميع الحقول.');</script>";
    } else {
        // تحقق من البريد الإلكتروني
        $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
        if (mysqli_num_rows($check_email) > 0) {
            echo "<script>alert('⚠️ البريد الإلكتروني مستخدم مسبقًا.');</script>";
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

<div class="container py-5">
    <div class="card shadow mb-4">
        <div class="header">
            <h4 class="mb-1 ps-3">إضافة مستخدم جديد</h4>
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

</body>
</html>
