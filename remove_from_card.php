<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $delete_sql = "DELETE FROM cart WHERE product_id = '$product_id' AND user_id = '$user_id'";
    
    if (mysqli_query($conn, $delete_sql)) {
        header("Location: card.php");
        exit();
    } else {
        echo "حدث خطأ أثناء الحذف: " . mysqli_error($conn);
    }
} else {
    echo "خطأ: لم يتم تحديد المنتج.";
}
?>