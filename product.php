<?php
include 'Database/db_connection.php';

// الحصول على معرف المنتج من الرابط (URL)
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // استعلام SQL لجلب تفاصيل المنتج بناءً على المعرف
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    // التحقق من وجود المنتج في قاعدة البيانات
    if ($result->num_rows > 0) {
        // جلب بيانات المنتج
        $product = $result->fetch_assoc();
    } else {
        echo "لم يتم العثور على المنتج.";
        exit();
    }
} else {
    echo "المعرف غير موجود.";
    exit();
}


// غلق الاتصال بقاعدة البيانات
$conn->close();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل المنتج</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="images/favicon/favicon.ico" type="image/x-icon">
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
          <li>
            <a href="#men-perfumes" class="nav-link text-dark">عطور له</a>
          </li>
          <li>
            <a href="#women-perfumes" class="nav-link text-dark">عطور لها</a>
          </li>
          <li>
            <a href="#unisex-perfumes" class="nav-link text-dark">عطور للجنسين</a>
          </li>
          <?php if ($role === 'admin'): ?>
            <li><a href="users.php" class="nav-link text-dark">لوحة التحكم</a></li>
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


    <div class="container mt-5">
        <h1 class="text-center mb-4">تفاصيل المنتج</h1>

        <div class="row">
            <div class="col-md-6">
                <!-- عرض صورة المنتج -->
                <img src="<?php echo htmlspecialchars($product['images']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <!-- عرض تفاصيل المنتج -->
                <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                <p><strong>الفئة:</strong> <?php  if (htmlspecialchars(str_replace('_', ' ', trim($product['category'])))=="best seller") echo'الأكثر مبيعا';  ?></p>
                <p><strong>الوصف:</strong> <?php echo nl2br(htmlspecialchars($product['perfume_detail'])); ?></p>                <p><strong>السعر:</strong>  <span class="text-success fw-bold">$<?php echo htmlspecialchars($product['price']); ?></span>  </p>
            </div>
        </div>
        
        <a href="index.php" class="btn btn-stone w-50">   اشتري الآن</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
