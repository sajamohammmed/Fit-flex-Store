<?php
include 'db.php';
session_start();

if(isset($_POST['save'])) {
    $user_id = $_SESSION['user_id'];
    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    $query = "UPDATE users SET 
              full_name='$full_name', 
              age='$age', 
              gender='$gender', 
              height='$height', 
              weight='$weight' 
              WHERE id='$user_id'";

    if(mysqli_query($conn, $query)) {
        header("Location: profile.php?msg=success");
    } else {
        echo "خطأ: " . mysqli_error($conn);
    }
}
?>