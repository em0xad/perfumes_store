<?php
session_start();
include __DIR__ . '/Database/db_connection.php';

// جلب المنتجات
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المنتجات</title>
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

        .card {
            border: 1px solid var(--dusty-pink);
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .card-title {
            color: var(--stone);
        }

        .price {
            color: var(--golden);
            font-weight: bold;
        }

        .header {
            background-color: var(--stone);
            color: var(--blanc);
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .card-img-top {
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="header">
        <h2>إدارة المنتجات</h2>
    </div>

    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if (!empty($row['image'])): ?>
                        <img src="uploads/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="صورة المنتج">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['product_name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                        <p class="card-text price"><?= htmlspecialchars($row['price']) ?> ريال</p>
                        <!-- يمكنك لاحقاً إضافة زر تعديل أو حذف هنا -->
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
