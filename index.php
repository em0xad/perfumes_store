<?php
session_start();
$role = $_SESSION['role'] ?? null;

// Include database connection
require_once 'Database/db_connection.php';

// Fetch all products from database
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

// Initialize arrays for different categories
$best_sellers = [];
$mens_perfumes = [];
$womens_perfumes = [];
$unisex_perfumes = [];

// Categorize products
while ($product = mysqli_fetch_assoc($result)) {
    // First 3 products are best sellers
    if (count($best_sellers) < 3) {
        $best_sellers[] = $product;
    }
    
    // Categorize based on product name
    if (stripos($product['product_name'], 'men') !== false || 
        stripos($product['product_name'], 'رجالي') !== false) {
        $mens_perfumes[] = $product;
    } elseif (stripos($product['product_name'], 'women') !== false || 
              stripos($product['product_name'], 'نسائي') !== false) {
        $womens_perfumes[] = $product;
    } else {
        $unisex_perfumes[] = $product;
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<style> 


@import url('https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap');
</style>
<head>
  <meta charset="UTF-8">
  <title>Emad Aladl | perfume </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="shortcut icon" href="images/favicon/favicon.ico" type="image/x-icon">

</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container position-relative justify-content-center">
    
    <a class="navbar-brand position-absolute top-50 start-50 translate-middle d-flex align-items-center" href="index.php">
      <span style="color: #D29F13;font-weight: bold; font-family: 'Monsieur La Doulaise';">Emad Aaldl</span>
      <img src="images/logo/logo1.png" alt="Logo" class="me-2" style="height: 75px; width: auto;">
    </a>

    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <img src="images/icon/menu.png" alt="Menu" style="height: 30px; width: auto;">
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">

    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">الرئيسية</a></li>
        <li class="nav-item"><a class="nav-link" href="#men-perfumes">عطور له</a></li>
        <li class="nav-item"><a class="nav-link" href="#women-perfumes">عطور لها</a></li>
        <li class="nav-item"><a class="nav-link" href="#unisex-perfumes">عطور للجنسسين</a></li>
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




  <!--banner-->

  <section class="hero-banner d-flex align-items-center text-center text-white" style="background-image: url('images//banner//slider1.jpg'); background-size: cover; background-position: center; height: 400px;">
    <div class="container">
      <h1 class="display-4 fw-bold" style="color:#D29F13;">اكتشف عالم العطور</h1>
      <p class="lead" style="color: #fff;">"كل عطر حكاية... وأجمل الحكايات تبدأ من الشرق."</p>
    </div>
  </section>


  <div class="container py-5">

    <!-- الأكثر مبيعاً -->
    <section class="mb-5">
      <h2 class="text-center section-title">الأكثر مبيعًا</h2>
      <hr>
      <div class="row">
        <?php foreach ($best_sellers as $product): ?>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/<?php echo htmlspecialchars($product['images']); ?>" alt="صورة المنتج" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

  </div>

  <!-- Decorative Image 1 -->
  <div class="w-100 my-5" style="height: 300px; overflow: hidden;">
    <img src="images/banner/5.jpg" alt="Decoration" class="w-100 h-100" style="object-fit: cover;">
  </div>

  <div class="container">
    <!-- عطور رجالية -->
    <section class="mb-5">
      <h2 class="text-center section-title" id="men-perfumes">عطور رجالية</h2>
      <hr>
      <div class="row">
        <?php foreach ($mens_perfumes as $product): ?>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/<?php echo htmlspecialchars($product['images']); ?>" alt="عطر رجالي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>
  </div>

  <!-- Decorative Image 2 -->
  <div class="w-100 my-5" style="height: 300px; overflow: hidden;">
    <img src="images/banner/4.jpg" alt="Decoration" class="w-100 h-100" style="object-fit: cover;">
  </div>

  <div class="container">
    <!-- عطور نسائية -->
    <section class="mb-5">
      <h2 class="text-center section-title" id="women-perfumes">عطور نسائية</h2>
      <hr>
      <div class="row">
        <?php foreach ($womens_perfumes as $product): ?>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/<?php echo htmlspecialchars($product['images']); ?>" alt="عطر نسائي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>
           
  </div>
           <!-- Decorative Image 3 -->
           <div class="w-100 my-5" style="height: 300px; overflow: hidden;">
              <img src="images/banner/3.jpg" alt="Decoration" class="w-100 h-100" style="object-fit: cover;">
            </div>
           <!-- عطور للجنسين -->
    <section class="mb-5">
      <h2 class="text-center section-title" id="unisex-perfumes">عطور للجنسين</h2>
      <hr>
      <div class="row">
        <?php foreach ($unisex_perfumes as $product): ?>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/<?php echo htmlspecialchars($product['images']); ?>" alt="عطر للجنسين" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p class="mb-0">© 2025 عطورات  <span style="font-family: 'Monsieur La Doulaise'">Emad  Aladel</span> - جميع الحقوق محفوظة</p>
    </div>
  </footer>

</body>

</html>