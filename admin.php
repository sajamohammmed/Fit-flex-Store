<?php
include 'db.php';

if(isset($_POST['add_product'])){
    $p_name = $_POST['product_name'];
    $p_price = $_POST['product_price'];
    $p_image = $_FILES['product_image']['name'];
    $p_image_tmp = $_FILES['product_image']['tmp_name'];
    $p_image_folder = 'image/'.$p_image;

    $insert = mysqli_query($conn, "INSERT INTO products(name, price, image) VALUES('$p_name', '$p_price', '$p_image')");

    if($insert){
        move_uploaded_file($p_image_tmp, $p_image_folder);
        echo "<script>alert('تم إضافة المنتج بنجاح');</script>";
    } else {
        echo "<script>alert('حدث خطأ أثناء الإضافة');</script>";
    }
}


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = '$delete_id'") or die('query failed');
   header('location:admin.php');
};
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitFlex Store - لوحة التحكم</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
        }
        body {
            display: flex;
            background-color: #f4f6f9;
            min-height: 100vh;
        }
        .sidebar {
            width: 260px;
            background-color: #1a1a2e;
            color: white;
            padding: 20px;
            min-height: 100vh;
        }
        .sidebar-brand {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #e0660c;
        }
        .sidebar-menu {
            list-style: none;
        }
        .sidebar-menu li {
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        .sidebar-menu li.active, .sidebar-menu li:hover {
            background-color: #e0660c;
        }
        .sidebar-menu li a {
            color: white;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }
        .main-content {
            flex: 1;
            padding: 30px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .header h1 {
            font-size: 24px;
            color: #333;
        }
        .crud-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .crud-card h3 {
            margin-bottom: 15px;
            color: #e0660c;
        }
        .form-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }
        .form-control {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .form-control label {
            font-size: 14px;
            color: #666;
        }
        .form-control input, .form-control select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
        }
        .btn-add {
            background-color: #e0660c;
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-add:hover {
            background-color: #b8520a;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #f8f9fa;
            color: #555;
            }
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }
        .actions-btns {
            display: flex;
            gap: 10px;
        }
        .btn-edit {
            color: #2ecc71;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
        .btn-delete {
            color: #e74c3c;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">FitFlex Admin</div>
        <ul class="sidebar-menu">
            <li class="active"><a href="admin.php"><i class="fa-solid His fa-box"></i> إدارة المنتجات</a></li>
            <li class="active"><a href="profile.php"><i class="fa-solid fa-right-from-bracket"></i>  حسابي </a></li>
            <li><a href="login.php"><i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>لوحة تحكم المسؤول </h1>
            <div class="admin-profile" style="font-weight: bold; color: #555;">أهلاً، المسؤول</div>
        </div>

        <div class="crud-card">
            <h3><i class="fa-solid fa-plus-circle"></i> إضافة منتج جديد للمتجر</h3>
            <form action="admin.php" method="POST" enctype="multipart/form-data">
             <div class="form-control">
                 <label>اسم المنتج</label>
                 <input type="text" name="product_name" placeholder="مثال: بروتين واي 1كغ" required>
             </div>
             <div class="form-control">
                 <label>السعر (ILS)</label>
                 <input type="number" name="product_price" placeholder="مثال: 150" required>
             </div>
             <div class="form-control">
                 <label>صورة المنتج</label>
                 <input type="file" name="product_image" accept="image/*" required>
              </div>
              <button type="submit" name="add_product" class="btn-add">إضافة المنتج</button>
            </form>
        </div>

        <div class="table-container">
            <h3 style="margin-bottom: 15px; color: #333;"><i class="fa-solid fa-boxes-stacked"></i> المنتجات الحالية</h3>
            <table>
                <table class="table-container">
   <thead>
      <tr>
         <th>الصورة</th>
         <th>اسم المنتج</th>
         <th>السعر</th>
         <th>العمليات الإدارية</th>
      </tr>
   </thead>
   <tbody>
      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM products");
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
      <tr>
         <td><img src="image/<?php echo $fetch_product['image']; ?>" height="100" alt="صورة المنتج"></td>
         <td><?php echo $fetch_product['name']; ?></td>
         <td><?php echo $fetch_product['price']; ?></td>
         <td>
            <a href="admin.php?delete=<?php echo $fetch_product['id']; ?>" class="btn-delete" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟');">حذف</a>
            <a href="update_product.php?edit=<?php echo $fetch_product['id']; ?>" class="btn-edit">تعديل</a>
         </td>
      </tr>
      <?php
            };
         }else{
            echo "<tr><td colspan='4'>لا توجد منتجات مضافة!</td></tr>";
         };
      ?>
   </tbody>
</table>
        </div>
    </div>

</body>
</html>