<?php
  session_start();
  include 'db.php';
  $query = "SELECT * FROM `products`";
  $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit Flex Store - المتجر</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: #7b676b;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #2b043e 0%, #1e022b 100%);
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e0663a;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 15px;
        }

        .sidebar-menu {
            list-style: none;
            flex-grow: 1;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cdb9df;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.3s;
        }

        .sidebar-menu li a:hover, .sidebar-menu li.active a {
            background-color: rgba(224, 102, 58, 0.2);
            color: #fff;
            font-weight: 600;
        }

        .logout-btn {
            background-color: #c9552b;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            transition: background 0.2s;
        }

        .main-content {
            flex: 1;
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            box-sizing: border-box;
            min-width: 0;
        }

        .top-header {
            background-color: white;
            padding: 15px 25px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #333;
        }

        .user-status {
            width: 10px;
            height: 10px;
            background-color: #e0663a;
            border-radius: 50%;
        }

        .store-banner {
            background: linear-gradient(90deg, #1e022b 0%, #330808 100%);
            color: white;
            text-align: center;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .store-banner h2 {
            font-size: 2.2rem;
            color: #e0663a;
            margin-bottom: 5px;
        }

        .filter-section {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        .search-control, .filter-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            font-size: 0.95rem;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
            gap: 20px;
            width: 100%;
            padding:20px;
        }

        .product-card {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            width: 100%;
            min-width: 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s;
            box-sizing: border-box;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image-container {
            width: 100%;
            height: 180px;
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .product-image-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            object-position:center;
        }

        .product-category {
            font-size: 0.8rem;
            color: #6b6987;
            margin-bottom: 5px;
        }

        .product-title {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .product-actions {
            width: 100%;
            display: flex;
            background-color: #e0663a;
            border-radius: 8px;
            overflow: hidden;
            color: white;
            align-items: stretch;
        }

        .add-to-cart-btn {
            flex: 1;
            background: transparent;
            border: none;
            color: white;
            padding: 10px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.2s;
        }

        .add-to-cart-btn:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .product-price {
            background-color: rgba(0, 0, 0, 0.15);
            padding: 10px 15px;
            font-weight: bold;
            min-width: 70px;
        }
        .dashboard-container{
            display:flex;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding:20px;
            width: 100%;
            min-height:100vh;
            background-color: #f4f6f9;
        }

        .product-card a{
            text-decoration: none !important;
            color: white !important;
            display: flex !important;
            align-items: center;
            justify-content: center;
            flex:1;
            height: 100%;
            box-sizing: border-box;
        }
        .product-actions span , 
        .product-actions div{
            color: white !important;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <div class="sidebar">
        <div>
            <div class="sidebar-brand">Fit Flex Store 🏋️‍♂️</div>
            <ul class="sidebar-menu">
                <li class="active"><a href="FitFlexStore.php">📦 المتجر</a></li>
                <li class="active"><a href="card.php">🛒 السلة</a></li>
                <li class="active"><a href="myorders.php">📜 طلباتي</a></li>
                <li class="active"><a href="profile.php">👤 حسابي</a></li>
            </ul>
        </div>
        <button class="logout-btn" onclick="location.href='logout.php'">تسجيل الخروج</button>
    </div>

    <div class="main-content">
        
        <div class="top-header">
            <div class="user-info">
                <span class="user-status"></span>
                <span><?php echo isset ($_SESSION['username'])? $_SESSION['username']: 'زائر';?></span>
            </div>
            <div class="cart-icon-wrapper">
                🛒 <span style="background:#e0663a; color:white; border-radius:50%; padding:2px 7px; font-size:0.8rem;">0</span>
            </div>
        </div>

        <div class="store-banner">
            <h2>مستلزمات الجيم </h2>
            <p>أفضل المنتجات الرياضية وبروتينات التغذية</p>
        </div>

        <div class="filter-section">
            <input type="text" class="search-control" placeholder="ابحث...">
            <select class="filter-select">
                <option>كل الفئات</option>
                <option>مكملات غذائية</option>
                <option>معدات تمرين</option>
                <option>ملابس رياضية </option>
                <option> اكسسوارات </option>
            </select>
        </div>

        <div class="products-grid">
            
           <div class="products-grid">
              <?php
               include 'db.php';

               $sql = "SELECT * FROM products";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                 echo '
        <div class="product-card">
            <div class="product-image-container">
                <img src="image/' . $row['image'] . '" alt="' . $row['name'] . '">
            </div>     
               <h3 class="product-title">' . $row['name'] . '</h3>

            <div class="product-actions">
                <p class="product-category">' . $row['description'] . '</p>
                <span class="product-price">' . $row['price'] . '₪</span>
                <a href="add_to_card.php?id=' . $row['id'] . '" class="order-btn">طلب</a>
            </div>
        </div>';
    }
} else {
    echo "<p>لا توجد منتجات حالية في المتجر.</p>";
}
?>
    <!--<div class="product-card">
        <div class="product-image-container">
            <img src="image/Protein1.jpg" alt="بروتين واي">
        </div>
        <div>
            <p class="product-category">مكملات غذائية</p>
            <h3 class="product-title">بروتين واي 1كغ - ستروبري</h3>
        </div>
        <div class="product-actions">
            <span class="product-price">149₪</span>
            <a href="add_to_card.php?id=1" class="order-btn">طلب</a>
        </div>
    </div>

    <div class="product-card">
        <div class="product-image-container">
            <img src="image/Protein2.jpg" alt="كرياتين">
        </div>
        <div>
            <p class="product-category">مكملات غذائية</p>
            <h3 class="product-title">كرياتين مونوهايدرات 500غ</h3>
        </div>
        <div class="product-actions">
            <span class="product-price">89₪</span>
            <a href="add_to_card.php?id=2" class="order-btn">طلب</a>
        </div>
    </div>

    <div class="product-card">
        <div class="product-image-container">
            <img src="image/Protein3.jpg" alt="BCAA">
        </div>
        <div>
            <p class="product-category">مكملات غذائية</p>
            <h3 class="product-title">BCAA - ليمون</h3>
        </div>
        <div class="product-actions">
            <span class="product-price">79₪</span>
            <a href="add_to_card.php?id=3" class="order-btn">طلب</a>
        </div>
    </div>

    <div class="product-card">
        <div class="product-image-container">
            <img src="image/Dumbbell.jpg" alt="دمبلز">
        </div>
        <div>
            <p class="product-category">معدات تمرين</p>
            <h3 class="product-title">دمبل 10كغ (زوج)</h3>
        </div>
        <div class="product-actions">
            <span class="product-price">220₪</span>
            <a href="add_to_card.php?id=4" class="order-btn">طلب</a>
        </div>
    </div>

    <div class="product-card">
        <div class="product-image-container">
            <img src="image/Belt.png" alt=" حزام حصر رياضي ">
        </div>
        <div>
            <p class="product-category">اكسسوارات </p>
            <h3 class="product-title">حزام حصر رياضي </h3>
        </div>
        <div class="product-actions">
            <span class="product-price">45₪</span>
            <a href="add_to_card.php?id=5" class="order-btn">طلب</a>
        </div>
    </div>

    <div class="product-card">
        <div class="product-image-container">
            <img src="image/Gloves.jpg" alt="قفازات">
        </div>
        <div>
            <p class="product-category"> اكسسوارات </p>
            <h3 class="product-title"> قفازات جيم </h3>
        </div>
        <div class="product-actions">
            <span class="product-price">180₪</span>
            <a href="add_to_card.php?id=6" class="order-btn">طلب</a>
        </div>
    </div>

    <div class="product-card">
        <div class="product-image-container">
            <img src="image/clothes1.jpg" alt=" ملابس رياضية ">
        </div>
        <div>
            <p class="product-category"> ملابس رياضية </p>
            <h3 class="product-title"> ترنق رياضي </h3>
        </div>
        <div class="product-actions">
            <span class="product-price">15₪</span>
            <a href="add_to_card.php?id=7" class="order-btn">طلب</a>
        </div>
    </div>

    <div class="product-card">
        <div class="product-image-container">
            <img src="image/JumpRope.jpg" alt=" معدات تمرين">
        </div>
        <div>
            <p class="product-category"> معدات تمرين </p>
            <h3 class="product-title">حبل قفز رياضي </h3>
        </div>
        <div class="product-actions">
            <span class="product-price">15₪</span>
            <a href="add_to_card.php?id=8" class="order-btn">طلب</a>
        </div>
    </div>-->

   
        </div>
    </div>
        </div>
    </div>
</div>
</body>
</html>