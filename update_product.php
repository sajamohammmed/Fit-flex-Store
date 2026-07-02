<?php
@include 'db.php';
session_start();

if(isset($_GET['edit'])){
   $id = $_GET['edit'];
} else {
   header('location:admin.php');
   exit();
}

if(isset($_POST['update_product'])){
   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $product_price = $_POST['product_price'];
   
   if(empty($product_name) || empty($product_price)){
      $message[] = 'يرجى تعبئة جميع الحقول';
   } else {
      $update_data = "UPDATE products SET name='$product_name', price='$product_price' WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);
      
      if($upload){
         header('location:admin.php');
         exit();
      } else {
         $message[] = 'حدث خطأ أثناء التحديث!';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
   <meta charset="UTF-8">
   <title>تعديل المنتج</title>
   <link rel="stylesheet" href="css/style.css"> 
    <style>
    body {
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .admin-product-form-container.centered {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(36, 8, 74, 0.1);
        width: 100%;
        max-width: 400px;
    }

    .admin-product-form-container h3 {
        text-align: center;
        margin-bottom: 20px;
        color: #0e0533;
    }

    .box {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .btn {
        background: #082341;
        color: #fff;
        border: none;
        padding: 10px;
        width: 100%;
        cursor: pointer;
        border-radius: 5px;
        text-align: center;
        display: block;
        text-decoration: none;
        font-size: 16px;
        margin-top: 10px;
        box-sizing: border-box;
    }

    .btn:hover {
        background: #555;
    }
</style>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<span class="message">'.$msg.'</span>';
   }
}
?>

<div class="admin-product-form-container centered">
   <?php
      $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
      if(mysqli_num_rows($select) > 0){
         while($row = mysqli_fetch_assoc($select)){
   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3>تعديل المنتج</h3>
      <input type="text" name="product_name" value="<?php echo $row['name']; ?>" class="box" required>
      <input type="number" name="product_price" value="<?php echo $row['price']; ?>" class="box" required>
      <input type="submit" value="تحديث المنتج" name="update_product" class="btn">
      <a href="admin.php" class="btn">رجوع</a>
   </form>
   
   <?php 
         }
      } else {
         echo "<p>المنتج غير موجود.</p>";
      }
   ?>
</div>

</body>
</html>