
<?php
session_start();
include'db.php';
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM `orders` WHERE user_id = '$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitFlex Store - طلباتي</title>
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
            background-color: #111;
            color: white;
            min-height: 100vh;
        }
        .sidebar {
            width: 260px;
            background-color: #120d3e;
            padding: 20px;
            border-left: 1px solid #2e085f;
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
            padding: 40px;
        }
        .orders-container {
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
            border: 1px solid #222;
        }
        .orders-container h2 {
            color: #e0660c;
            margin-bottom: 25px;
            border-bottom: 2px solid #e0660c;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
            margin-top: 15px;
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #333;
        }
        th {
            background-color: #222;
            color: #e0660c;
            font-weight: bold;
        }
        td {
            color: #ddd;
        }
        .status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
        }
        .status.pending {
            background-color: #f39c1222;
            color: #f39c12;
            border: 1px solid #f39c12;
        }
        .status.completed {
            background-color: #2ecc7122;
            color: #2ecc71;
            border: 1px solid #2ecc71;
        }
        .status.shipped {
            background-color: #3498db22;
            color: #3498db;
            border: 1px solid #3498db;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">FitFlex Store</div>
        <ul class="sidebar-menu">
            <li><a href="FitFlexStore.php"><i class="fa-solid fa-house"></i> المتجر الرئيسي</a></li>
            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="orders-container">
            <h2><i class="fa-solid fa-box-open"></i> سجل طلباتي السابقة</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>التاريخ</th>
                        <th>إجمالي المبلغ</th>
                        <th>حالة الطلب</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(mysqli_num_rows($result)> 0){
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                              <td><?php echo $row['id']; ?></td>
                              <td><?php echo $row['created_at']; ?></td>
                              <td><?php echo $row['total_price']; ?>شيكل </td>
                                 <td>
                                  <?php if ($row['status']== 'completed'){ ?>
                                      <span class = "status completed"><i class = "fa-solid fa-circle-check"></i> التوصيل تم  </span>
                                  <?php }else { ?>
                                      <span class = "status pending"><i class = "fa-solid fa-rotate-left"></i> الانتظار قيد </span>
                                  <?php }?>
                                 </td>
                            </tr>
                           <?php
                        }
                    }
                         else{ ?>
                         <tr>
                            <td colspan="4" style="text-align:center; padding:20px;">ليس لديك أي طلبات سابقة حتى الأن </td>
                         </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
