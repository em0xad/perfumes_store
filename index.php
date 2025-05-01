<?php
session_start();
$role = $_SESSION['role'] ?? null;
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<style>     @import url('https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap');
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
    
    <!-- العنصر في المنتصف -->
    <a class="navbar-brand position-absolute top-50 start-50 translate-middle d-flex align-items-center" href="index.php">
      <span style="color: #D29F13;font-weight: bold; font-family: 'Monsieur La Doulaise';">Emad Aaldl</span>
      <img src="images/logo/logo1.png" alt="Logo" class="me-2" style="height: 50px; width: auto;">
    </a>

    <!-- زر القائمة على اليمين -->
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <img src="images/icon/menu.png" alt="Menu" style="height: 30px; width: auto;">
    </button>

    <!-- العناصر اليسار واليمين -->
    <div class="collapse navbar-collapse" id="navbarMain">
      <!-- القائمة اليمنى -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">الرئيسية</a></li>
        <li class="nav-item"><a class="nav-link" href="#men-perfumes">عطور له</a></li>
        <li class="nav-item"><a class="nav-link" href="#women-perfumes">عطور لها</a></li>
        <?php if ($role === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="users.php">لوحة التحكم</a></li>
        <?php endif; ?>
      </ul>

      <!-- القائمة اليسرى -->
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

        <div class="col-md-4 mb-4 d-flex  d-flex " >
          <div class="card product-card">
            <img src="images/best-product/B1-1.png" alt="صورة المنتج " class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Dolce & Gabbana Women </h5>
              <p class="card-text">وصف مختصر عن المنتج الأكثر مبيعًا.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex  d-flex ">
          <div class="card product-card">
            <img src="images/best-product/B2-1.png" alt="صورة المنتج " class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Jean Paul Gaultier  </h5>
              <p class="card-text">وصف مختصر عن المنتج الأكثر مبيعًا.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex  d-flex ">
          <div class="card product-card">
            <img src="images/best-product/B3-1.png" alt="صورة المنتج " class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Carolina Harrera Women 212 VIP  </h5>
              <p class="card-text">وصف مختصر عن المنتج الأكثر مبيعًا.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- عطور رجالية -->
    <section class="mb-5">
      <h2 class="text-center section-title" id="men-perfumes">عطور رجالية</h2>
      <hr>
      <div class="row">

        <div class="col-md-4 mb-4 d-flex  d-flex ">
          <div class="card product-card">
            <img src="images/products/Men/1-1.png" alt="عطر رجالي  class=" card-img-top">
            <div class="card-body">
              <h5 class="card-title">Jaguar Men Classic EDT  </h5>
              <p class="card-text">رائحة قوية وعصرية تناسب الرجل العصري.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex  d-flex ">
          <div class="card product-card">
            <img src="images/products/Men/2-1.png" alt="عطر رجالي "class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Versace Men Dylan</h5>
              <p class="card-text">رائحة قوية وعصرية تناسب الرجل العصري.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex  d-flex ">
          <div class="card product-card">
            <img src="images/products/Men/3-1.png"  alt="عطر رجالي "class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">GIORGIO ARMANI Aqua Di Gio</h5>
              <p class="card-text">رائحة قوية وعصرية تناسب الرجل العصري.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex ">
          <div class="card product-card">
            <img src="images/products/Men/4-1.png"  alt="عطر رجالي "class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Dunhill Men Icon Elite</h5>
              <p class="card-text">رائحة قوية وعصرية تناسب الرجل العصري.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex ">
          <div class="card product-card">
            <img src="images/products/Men/5-1.png"  alt="عطر رجالي "class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Paco Rabbane Men Invictus </h5>
              <p class="card-text">رائحة قوية وعصرية تناسب الرجل العصري.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex ">
          <div class="card product-card">
            <img src="images/products/Men/6-1.png"  alt="عطر رجالي "class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Carolina Harrera Bad Boy</h5>
              <p class="card-text">رائحة قوية وعصرية تناسب الرجل العصري.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- عطور نسائية -->
    <section>
      <h2 class="text-center section-title" id="women-perfumes">عطور نسائية</h2>
      <hr>
      <div class="row">
        <div class="col-md-4 mb-4 d-flex ">
          <div class="card product-card">
            <img src="images/products/women/1-1.png" alt="عطر نسائي " class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"> Dolce & Gabbana Women The Only</h5>
              <p class="card-text">عبير أنثوي ناعم يدوم طوال اليوم.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex ">
          <div class="card product-card">
            <img src="images/products/women/2-1.png" alt="Michael Kors Women Sexy " class="card-img-top">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Michael Kors Women Sexy</h5>
              <p class="card-text">عبير أنثوي ناعم يدوم طوال اليوم.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4 d-flex ">
          <div class="card product-card">
            <img src="images/products/women/3-1.png" alt=" Bvlgari Splendid Jasmin Noir " class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"> Bvlgari Splendid Jasmin Noir </h5>
              <p class="card-text">عبير أنثوي ناعم يدوم طوال اليوم.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4 d-flex ">
          <div class="card product-card">
            <img src="images/products/women/4-1.png" alt="عطر نسائي " class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Versace Pour Femme Dylan Blue</h5>
              <p class="card-text">عبير أنثوي ناعم يدوم طوال اليوم.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4 d-flex ">
          <div class="card product-card">
            <img src="images/products/women/5-1.png" alt="عطر نسائي " class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Carolina Herrera Women Good Girl</h5>
              <p class="card-text">عبير أنثوي ناعم يدوم طوال اليوم.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 d-flex ">
          <div class="card product-card">
            <img src="images/products/women/6-1.png" alt="عطر نسائي " class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Jean Paul Gaultier Women Scandal</h5>
              <p class="card-text">عبير أنثوي ناعم يدوم طوال اليوم.</p>
              <a href="#" class="btn btn-stone w-100">عرض التفاصيل</a>
            </div>
          </div>
        </div>




      </div>
    </section>

  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p class="mb-0">© 2025 عطورات  <span style="font-family: 'Monsieur La Doulaise'">Emad  Aladel</span> - جميع الحقوق محفوظة</p>
    </div>
  </footer>

</body>

</html>