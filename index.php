<?php
session_start();
$role = $_SESSION['role'] ?? null;
include 'Database/db_connection.php';

// جلب المنتجات من قاعدة البيانات
$men_products = [];
$women_products = [];
$unisex_products = [];
$best_seller = [];

$result = $conn->query("SELECT * FROM products");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        switch ($row['category']) {
            case 'men':
                $men_products[] = $row;
                break;
            case 'women':
                $women_products[] = $row;
                break;
            case 'unisex':
                $unisex_products[] = $row;
                break;
            case 'best_seller':
                $best_seller[] = $row;
                break;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <title>Emad Aladl | perfume </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="shortcut icon" href="images/favicon/favicon.ico" type="image/x-icon">
  <style>/* تنسيق الصورة الأساسية */
  @import url('https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap');

.image-wrapper {
  position: relative;
}

.card-img-top {
  width: 100%;
  transition: opacity 0.3s ease-in-out; /* إضافة تأثير انتقال للظهور */
}

/* الصورة الثانية التي ستظهر عند التمرير */
.hover-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0; /* الصورة الثانية مخفية بشكل افتراضي */
  transition: opacity 0.3s ease-in-out; /* إضافة تأثير انتقال عند الظهور */
}

.product-card:hover .hover-image {
  opacity: 1; 
}

.product-card:hover .main-image {
  opacity: 0; 
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



  
  <!--banner-->

  <section class="hero-banner d-flex align-items-center text-center text-white" style="background-image: url('images//banner//slider1.jpg'); background-size: cover; background-position: center; height: 400px;">
    <div class="container">
      <h1 class="display-4 fw-bold" style="color:#D29F13;">اكتشف عالم العطور</h1>
      <p class="lead" style="color: #fff;">"كل عطر حكاية... وأجمل الحكايات تبدأ من الشرق."</p>
    </div>
  </section>

              <br>
  <div class="container">
    <!--  الأكثر مبيعا  -->
    <section>
        <h2 class="text-center section-title" id="women-perfumes">الأكثر مبيعا</h2>
        <hr>
        <div class="row">
            <?php foreach ($best_seller as $product): ?>
                <?php
                    // معالجة الصور
                    $image1 = htmlspecialchars($product['images']);
                    $image2 = preg_replace('/-1(\.\w+)$/', '-2$1', $image1);
                    $productName = htmlspecialchars($product['product_name']);
                    $productDescription = htmlspecialchars($product['description']);
                    $productId = htmlspecialchars($product['id']);
                ?>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card product-card">
                        <div class="image-wrapper position-relative">
                            <img src="<?php echo $image1; ?>" alt="صورة المنتج - <?php echo $productName; ?>" class="card-img-top main-image">
                            <img src="<?php echo $image2; ?>" alt="صورة أخرى - <?php echo $productName; ?>" class="card-img-top hover-image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $productName; ?></h5>
                            <p class="card-text"><?php echo $productDescription; ?></p>
                            <a href="product.php?id=<?php echo $productId; ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
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
      <?php foreach ($men_products as $product): ?>
                <?php
                    $image1 = htmlspecialchars($product['images']);
                    $image2 = preg_replace('/-1(\.\w+)$/', '-2$1', $image1);
                    $productName = htmlspecialchars($product['product_name']);
                    $productDescription = htmlspecialchars($product['description']);
                    $productId = htmlspecialchars($product['id']);
                ?>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card product-card">
                        <div class="image-wrapper position-relative">
                            <img src="<?php echo $image1; ?>" alt="صورة المنتج - <?php echo $productName; ?>" class="card-img-top main-image">
                            <img src="<?php echo $image2; ?>" alt="صورة أخرى - <?php echo $productName; ?>" class="card-img-top hover-image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $productName; ?></h5>
                            <p class="card-text"><?php echo $productDescription; ?></p>
                            <a href="product.php?id=<?php echo $productId; ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
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
    <section>
      <h2 class="text-center section-title" id="women-perfumes">عطور نسائية</h2>
      <hr>
      <div class="row">
      <?php foreach ($women_products as $product): ?>
        <div class="col-md-4 mb-4 d-flex">
  <div class="card product-card">
    <div class="image-wrapper position-relative">
    <?php
        $image1 = htmlspecialchars($product['images']);
        $image2 = preg_replace('/-1(\.\w+)$/', '-2$1', $image1);
    ?>
      <!-- الصورة الأساسية -->
      <img src="<?php echo $image1; ?>"  alt="صورة المنتج" class="card-img-top main-image">
      <!-- الصورة الثانية المحلية -->
      <img src="<?php echo $image2; ?>"  alt="صورة أخرى" class="card-img-top hover-image">
    </div>
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
    <section>
      <h2 class="text-center section-title"  id="unisex-perfumes">عطور للجنسين</h2>
      <hr>
      <div class="row">
      <?php foreach ($unisex_products as $product): ?>
                <?php
                    // معالجة الصور
                    $image1 = htmlspecialchars($product['images']);
                    $image2 = preg_replace('/-1(\.\w+)$/', '-2$1', $image1);
                    $productName = htmlspecialchars($product['product_name']);
                    $productDescription = htmlspecialchars($product['description']);
                    $productId = htmlspecialchars($product['id']);
                ?>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card product-card">
                        <div class="image-wrapper position-relative">
                            <img src="<?php echo $image1; ?>" alt="صورة المنتج - <?php echo $productName; ?>" class="card-img-top main-image">
                            <img src="<?php echo $image2; ?>" alt="صورة أخرى - <?php echo $productName; ?>" class="card-img-top hover-image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $productName; ?></h5>
                            <p class="card-text"><?php echo $productDescription; ?></p>
                            <a href="product.php?id=<?php echo $productId; ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>