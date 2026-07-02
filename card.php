<?php
session_start();
include 'db.php'; 
$conn = mysqli_connect("localhost" , "root", "", "fitflexstore");

if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    
    if (!isset($_SESSION['card'])) {
        $_SESSION['card'] = [];
    }
    
    if (isset($_SESSION['card'][$product_id])) {
        $_SESSION['card'][$product_id]++;
    } else {
        $_SESSION['card'][$product_id] = 1;
    }
    
    header("Location: card.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سلة التسوق - GymStore</title>
    <style>
        .dashboard-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            background-color: #f4f6f9;
            font-family: sans-serif;
        }
         .sidebar {
            width: 260px;
            background-color: #1a1a1a;
            padding: 20px;
            border-left: 1px solid #222;
        }
        .sidebar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #e0660c;
            text-align: center;
            margin-bottom: 30px;
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
        .sidebar-menu li:hover, .sidebar-menu li.active {
            background-color: #e0660c;
        }
        .sidebar-menu li a {
            color: white;
            text-decoration: none;
            display: block;
        }
        .main-content {
            flex: 1;
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            box-sizing: border-box;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .cart-table th, .cart-table td {
            padding: 15px;
            text-align: right;
            border-bottom: 1px solid #eee;
        }
        .cart-table th {
            background-color: #333;
            color: white;
        }
        .empty-cart-msg {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 12px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="sidebar">
        <div class="sidebar-brand">FitFlex Store</div>
        <ul class="sidebar-menu">
            <li><a href="FitFlexStore.php"><i class="fa-solid fa-house"></i> المتجر الرئيسي</a></li>    </div>

<div class="dashboard-container">
    
    <div class="sidebar">
        </div>

    <div class="main-content">
        <h2>🛒 سلة التسوق الخاصة بكِ</h2>
        
        <?php ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>المنتج</th>
                        <th>الكمية</th>
                        <th>السعر الفردي</th>
                        <th>الإجمالي</th>
                        <th>حذف </th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                      $total_store_price = 0;

                     $user_id = $_SESSION['user_id'];
                     $query = "SELECT cart.*, products.name, products.price 
                           FROM cart INNER JOIN products ON cart.product_id = products.id 
                           WHERE cart.user_id = '$user_id'";

                      $result = mysqli_query($conn, $query);


                     while ($row = mysqli_fetch_assoc($result)) {
                      $p_name = $row['name'];
                      $p_price = $row['price'];
                      $quantity = $row['quantity'];
                      $subtotal = $p_price * $quantity;
                      $total_store_price += $subtotal;
                    ?>
                      <tr>
                         <td><?php echo $p_name; ?></td>
                         <td><?php echo $quantity; ?></td>
                         <td><?php echo $p_price; ?></td>
                         <td><?php echo $subtotal; ?></td>
                         <td><a href='remove_from_card.php?id=<?php echo $row['product_id']; ?>' style="color:red; text-decoration: none;">حذف</a></td>
                       </tr>
              <?php 
                }
                ?>

                        <tr>
                          <td colspan="3" style="text-align: left; font-weight: bold;">المجموع الكلي</td>
                         <td style="font-weight: bold; color: #e03a3a;"><?php echo $total_store_price; ?></td>
                      <td></td>
                    </tr>
                 <?php  
                  if(mysqli_num_rows($result)> 0){ ?>
                    <table class="cart_table"></table>
                     <div style = "text-align: left; margin-top:20px;">
                          <a href= "make_order.php" style= "display: inline-block;
                             width: max-content;
                             padding: 14px 35px;
                             background-color: #e25f07;
                             color: #ffffff;
                             text-decoration: none;
                             font-size: 1.1rem;
                             font-weight: bold; 
                             border-radius: 5px;
                             transition: all 0.3s ease;
                              box-shadow: 0 5px 15px rgba(255, 74, 17, 0.4);

                             ">إتمام الشراء وتأكيد الطلب </a>
                      </div>
                 <?php  }else { ?>
                        <div class="empty-cart-msg">
                          <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" width="80" alt="سلة فارغة">
                          <p>السلة فارغة حالياً. اذهب للمتجر واضف بعض المنتجات!</p>
                        </div>
                <?php } ?>     
</body>
</html>