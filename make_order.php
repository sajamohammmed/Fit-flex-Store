<?php

session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("خطأ: يرجى تسجيل الدخول.");
}

$user_id = $_SESSION['user_id'];

$check_cart_sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
$check_cart_result = mysqli_query($conn, $check_cart_sql);

if (mysqli_num_rows($check_cart_result) == 0) {
    die("خطأ: السلة فارغة، لا يمكنك إتمام الطلب.");
}

$total_price = 0; 
$query = "INSERT INTO orders (user_id, total_price, status, created_at) VALUES ('$user_id', '$total_price', 'pending', NOW())";

if (mysqli_query($conn, $query)) {
    $order_id = mysqli_insert_id($conn);

    while ($item = mysqli_fetch_assoc($check_cart_result)) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];

        $res = mysqli_query($conn, "SELECT price FROM products WHERE id = '$product_id'");
        $row = mysqli_fetch_assoc($res);
        $price = $row['price'];

        $item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
        mysqli_query($conn, $item_query);
    }

    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");

    echo "تم إتمام الطلب بنجاح! رقم طلبك هو: " . $order_id;
} else {
    echo "حدث خطأ: " . mysqli_error($conn);
}
?>
