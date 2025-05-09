<?php
session_start();
include __DIR__ . '/Database/db_connection.php';
$role = $_SESSION['role'] ?? null;
// حذف منتج
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header("Location: products.php");
    exit();
}

// تعديل منتج
$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = intval($_GET['edit']);
    $edit_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = $edit_id"));
}

// إضافة / تحديث
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;
    $name = trim($_POST['product_name']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $detail = trim($_POST['perfume_detail']);
    $notes = trim($_POST['perfume_notes']);

    if ($edit_mode) {
        $stmt = $conn->prepare("UPDATE products SET product_name=?, price=?, description=?, category=?, perfume_detail=?, perfume_notes=? WHERE id=?");
        $stmt->bind_param("sdssssi", $name, $price, $description, $category, $detail, $notes, $edit_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO products (product_name, price, description, category, perfume_detail, perfume_notes) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdssss", $name, $price, $description, $category, $detail, $notes);
    }

    $stmt->execute();
    header("Location: products.php");
    exit();
}

// جلب المنتجات
$products = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المنتجات</title>
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
.header {
    background-color: var(--stone);
    color: var(--blanc);
    padding: 1rem 1.5rem;
    border-radius: 0.5rem;
    text-align: center;
    margin-bottom: 2rem;
}
.btn-golden {
    background-color: var(--golden);
    color: white;
}
.btn-golden:hover {
    background-color: rgb(185, 140, 15);
}
.form-box {
    background-color: white;
    padding: 1.5rem;
    border: 1px solid var(--dusty-pink);
    border-radius: 0.5rem;
    margin-bottom: 2rem;
}
.card {
    border: 1px solid var(--dusty-pink);
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}
.card-title { color: var(--stone); }
.price { color: var(--golden); font-weight: bold; }
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


    <!-- Side Nav (Offcanvas) -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
      
      <div class="offcanvas-header">
        
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="close"></button>
      </div>
      
      <div class="offcanvas-body">
        <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
          <img src="images/logo/logo1.png" alt="Logo" style="height: 50px; width: auto;" class="me-2">
          <span style="color: #D29F13; font-weight: bold;">Emad Aaldl</span>
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


<div class="container py-4">
    <div class="header">
        <h2><?= $edit_mode ? "تعديل عطر" : "إضافة عطر جديد" ?></h2>
    </div>

    <div class="form-box">
        <form method="POST">
            <?php if ($edit_mode): ?>
                <input type="hidden" name="product_id" value="<?= $edit_id ?>">
            <?php endif; ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="product_name" class="form-control" placeholder="اسم العطر" required value="<?= $edit_mode ? $edit_data['product_name'] : '' ?>">
                </div>
                <div class="col-md-6">
                    <input type="number" step="10" name="price" class="form-control" placeholder="السعر"  required value="<?= $edit_mode ? $edit_data['price'] : '' ?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="description" class="form-control" placeholder="الوصف" value="<?= $edit_mode ? $edit_data['description'] : '' ?>">
                </div>
                <div class="col-md-6">
                    <select name="category" class="form-control" required>
                        <option value="  @import url('https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap');
" <?= $edit_mode && $edit_data['category'] == 'men' ? 'selected' : '' ?>>رجالي</option>
                        <option value="women" <?= $edit_mode && $edit_data['category'] == 'women' ? 'selected' : '' ?>>نسائي</option>
                        <option value="women" <?= $edit_mode && $edit_data['category'] == 'unisex' ? 'selected' : '' ?>>للجنسءين</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <input type="text" name="perfume_detail" class="form-control" placeholder="تفاصيل العطر" value="<?= $edit_mode ? $edit_data['perfume_detail'] : '' ?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="perfume_notes" class="form-control" placeholder="نوتات العطر" value="<?= $edit_mode ? $edit_data['perfume_notes'] : '' ?>">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-golden px-4"><?= $edit_mode ? 'تحديث' : 'إضافة' ?></button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <?php while ($product = mysqli_fetch_assoc($products)): ?>
            <div class="col-md-4 mb-4">
    <div class="card h-100 d-flex flex-column">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-center"><?= htmlspecialchars($product['product_name']) ?></h5>
            <p class="price text-center"><?= htmlspecialchars($product['price']) ?> دولار</p>

            <div class="mt-auto text-center pt-2">
                <button class="btn btn-golden btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal<?= $product['id'] ?>">
                    عرض التفاصيل
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailsModal<?= $product['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $product['id'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="modalLabel<?= $product['id'] ?>">تفاصيل المنتج: <?= htmlspecialchars($product['product_name']) ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body">
        <p><strong>الوصف:</strong> <?= htmlspecialchars($product['description']) ?></p>
        <p><strong>الفئة:</strong> 
                  <?php  
                      if (htmlspecialchars(str_replace('_', ' ', trim($product['category']))) == "best seller") {
                          echo 'الأكثر مبيعا';
                      } elseif(htmlspecialchars($product['category'])=='men') {
                          echo ' رجالي';
                      }
                      elseif(htmlspecialchars($product['category'])=='women') {
                        echo ' نسائي';
                      }
                      else echo' للجنسيين';
                   ?>
            </p>        <p><strong>تفاصيل العطر:</strong> <?= htmlspecialchars($product['perfume_detail']) ?></p>
        <p><strong>نوتات العطر:</strong> <?= htmlspecialchars($product['perfume_notes']) ?></p>
      </div>
      <div class="modal-footer justify-content-between">
        <a href="products.php?edit=<?= $product['id'] ?>" class="btn btn-golden btn-sm">تعديل</a>
        <a href="products.php?delete=<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">حذف</a>
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">إغلاق</button>
      </div>
    </div>
  </div>
</div>

        <?php endwhile; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
