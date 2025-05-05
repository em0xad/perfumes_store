<?php
session_start();
$role = $_SESSION['role'] ?? null;
include 'Database/db_connection.php';

// جلب المنتجات من قاعدة البيانات
$men_products = [];
$women_products = [];
$unisex_products = [];
$best_selling = [];

$result = $conn->query("SELECT * FROM products");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        if (stripos($row['images'], 'Men') !== false) {
            $men_products[] = $row;
        } elseif (stripos($row['images'], 'women') !== false) {
            $women_products[] = $row;
        } elseif (stripos($row['images'], 'Unisex') !== false) {
            $unisex_products[] = $row;
        }
        if (count($best_selling) < 3) {
            $best_selling[] = $row;
        }
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
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/best-product/B1-1.png" alt="صورة المنتج" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Dolce & Gabbana Women</h5>
              <p class="card-text">عطر نسائي كلاسيكي يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الياسمين والورد.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/best-product/B2-1.png" alt="صورة المنتج" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Jean Paul Gaultier</h5>
              <p class="card-text">عطر جريء يجمع بين الفانيليا الدافئة والمسك، مع لمسة من الزنجبيل والحمضيات.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/best-product/B3-1.png" alt="صورة المنتج" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Carolina Harrera Women 212 VIP</h5>
              <p class="card-text">عطر أنثوي فاخر يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الفانيليا.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
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
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Men/1-1.png" alt="عطر رجالي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Jaguar Men Classic EDT</h5>
              <p class="card-text">عطر رجالي كلاسيكي يجمع بين نضارة الحمضيات ودفء الخشب، مع لمسة من التوابل.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Men/2-1.png" alt="عطر رجالي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Versace Men Dylan</h5>
              <p class="card-text">عطر رجالي عصري يجمع بين نضارة الحمضيات ودفء الخشب، مع لمسة من المسك.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Men/3-1.png" alt="عطر رجالي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">GIORGIO ARMANI Aqua Di Gio</h5>
              <p class="card-text">عطر رجالي كلاسيكي يجمع بين نضارة الحمضيات البحرية ودفء المسك، مع لمسة من الخشب.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Men/4-1.png" alt="عطر رجالي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Dunhill Men Icon Elite</h5>
              <p class="card-text">عطر رجالي فاخر يجمع بين نضارة الحمضيات ودفء الخشب، مع لمسة من التوابل.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Men/5-1.png" alt="عطر رجالي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Paco Rabbane Men Invictus</h5>
              <p class="card-text">عطر رجالي جريء يجمع بين نضارة الحمضيات ودفء الخشب، مع لمسة من المسك.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Men/6-1.png" alt="عطر رجالي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Carolina Harrera Bad Boy</h5>
              <p class="card-text">عطر رجالي جريء يجمع بين نضارة الحمضيات ودفء الخشب، مع لمسة من التوابل.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
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
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/women/1-1.png" alt="عطر نسائي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Dolce & Gabbana Women The Only</h5>
              <p class="card-text">عطر نسائي فاخر يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الفانيليا.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/women/2-1.png" alt="عطر نسائي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Michael Kors Women Sexy</h5>
              <p class="card-text">عطر نسائي جريء يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الفانيليا.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/women/3-1.png" alt="عطر نسائي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Bvlgari Splendid Jasmin Noir</h5>
              <p class="card-text">عطر نسائي فاخر يجمع بين نضارة الياسمين ودفء المسك، مع لمسة من الفانيليا.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/women/4-1.png" alt="عطر نسائي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Versace Pour Femme Dylan Blue</h5>
              <p class="card-text">عطر نسائي عصري يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الفانيليا.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/women/5-1.png" alt="عطر نسائي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Carolina Herrera Women Good Girl</h5>
              <p class="card-text">عطر نسائي جريء يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الفانيليا.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/women/6-1.png" alt="عطر نسائي" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Jean Paul Gaultier Women Scandal</h5>
              <p class="card-text">عطر نسائي جريء يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الفانيليا.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
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
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Unisex/1-1.png" alt="عطر للجنسين" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Dolce & Gabbana Women The Only</h5>
              <p class="card-text">عطر للجنسين يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الخشب.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Unisex/2-1.png" alt="عطر للجنسين" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Michael Kors Women Sexy</h5>
              <p class="card-text">عطر للجنسين يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الخشب.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Unisex/3-1.png" alt="عطر للجنسين" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Bvlgari Splendid Jasmin Noir</h5>
              <p class="card-text">عطر للجنسين يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الخشب.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Unisex/4-1.png" alt="عطر للجنسين" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Versace Pour Femme Dylan Blue</h5>
              <p class="card-text">عطر للجنسين يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الخشب.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Unisex/5-1.png" alt="عطر للجنسين" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Carolina Herrera Women Good Girl</h5>
              <p class="card-text">عطر للجنسين يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الخشب.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex">
          <div class="card product-card">
            <img src="images/products/Unisex/6-1.png" alt="عطر للجنسين" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Jean Paul Gaultier Women Scandal</h5>
              <p class="card-text">عطر للجنسين يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الخشب.</p>
              <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
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