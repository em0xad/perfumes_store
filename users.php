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

        .header {
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
            background-color: var(--golden);
        }

        .badge-user {
            background-color: var(--stone);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card shadow">
        <div class="header">
            <h4 class="mb-0">إدارة المستخدمين</h4>
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
