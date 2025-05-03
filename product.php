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
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل المنتج</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>/* تنسيقات عامة للصفحة */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    color: #333;
    margin: 0;
    padding: 0;
}

/* تنسيق عنوان الصفحة */
h1 {
    font-size: 2.5rem;
    color: #333;
    margin-top: 20px;
    margin-bottom: 40px;
    text-align: center;
}

/* تنسيق تفاصيل المنتج */
.product-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 40px;
}

.product-container .product-image {
    flex: 1;
    max-width: 500px;
    margin-right: 20px;
}

.product-container .product-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.product-container .product-details {
    flex: 1;
    max-width: 500px;
}

.product-container .product-details h2 {
    font-size: 2rem;
    color: #222;
    margin-bottom: 20px;
}

.product-container .product-details p {
    font-size: 1rem;
    color: #555;
    margin-bottom: 10px;
}

/* تنسيق زر العودة */
.btn-back {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.btn-back:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>
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
                <p><strong>الفئة:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
                <p><strong>الوصف:</strong> <?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            </div>
        </div>
        
        <a href="index.php" class="btn btn-primary mt-4">العودة إلى الصفحة الرئيسية</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
