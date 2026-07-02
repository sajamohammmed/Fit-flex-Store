<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row= mysqli_fetch_assoc($result);
        $_SESSION['user_id']= $row['id'];
        $_SESSION['username']= $username;
        $_SESSION['role']=$row['role'];

        if ($row['role']== 'admin'){
            header("Location:admin.php");
        }else{
           header("Location: FitFlexStore.php"); 
        exit();
    }
         echo "<script>alert('اسم المستخدم أو كلمة المرور غير صحيحة!');</script>";

    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymStore - تسجيل الدخول</title>
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
            background: linear-gradient(135deg , #330808 0% , #2b043e 100%); /* الخلفية الكحلي الغامق للموقع */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            background-color: #f8f9fa;
            width: 100%;
            max-width: 450px;
            padding: 40px 30px;
            border-radius: 24px; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
        }

        .logo-text {
            color: #ee660c; 
            font-size: 2rem;
            font-weight: 700;
        }

        .logo-icon {
            font-size: 1.8rem;
        }

        .subtitle {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 25px;
        }

        .tab-container {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .tab-btn {
            flex: 1;
            padding: 10px 0;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .tab-active {
            background-color: #ee660c; 
            color: #ffffff;
            border: none;
        }

        .tab-inactive {
            background-color: transparent;
            color: #6c757d;
            border: 1px solid #cccccc;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: right; 
        }

        .form-group label {
            display: block;
            color: #333333;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background-color: #eef2f5; 
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            color: #333;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #ee660c;
        }

        .toggle-password {
            position: absolute;
            left: 15px; 
            cursor: pointer;
            color: #a0aec0;
            font-size: 1.1rem;
            user-select: none;
        }

        .submit-btn {
            width: 100%;
            background-color: #ee660c;
            color: white;
            border: none;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            transition: background 0.2s;
        }

        .submit-btn:hover {
            background-color: #610879;
        }

         .demo-data {
            margin-top: 30px;
            font-size: 0.8rem;
            color: #640cad;
            line-height: 1.6;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo-container">
            <span class="logo-text">Fit Flex Store</span>
        </div>
        <p class="subtitle">متجر متكامل لمستلزمات الجيم والتغذية الرياضية</p>

        <div class="tab-container">
            <button class="tab-btn tab-active">تسجيل الدخول</button>
            <button class="tab-btn tab-inactive" onclick="location.href='register.php'">حساب جديد</button>
        </div>

        <form action="login.php" method="POST">
            
            <div class="form-group">
                <label>اسم المستخدم</label>
                <div class="input-wrapper">
                    <input type="text" name="username" class="form-control" placeholder="admin أو user1" required>
                </div>
            </div>

            <div class="form-group">
                <label>كلمة المرور</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" class="form-control" placeholder="كلمة المرور" required>
                    <span class="toggle-password" onclick="togglePass()">🕶️</span>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                <span>دخول</span>
                <span>←</span>
            </button>
        </form>

        <div class="demo-data">
            <p>بيانات تجريبية:</p>
            <p>مدير / admin / admin123</p>
            <p>عميل / user1 / user123</p>
        </div>
    </div>

    <script>
        function togglePass() {
            var passInput = document.getElementById("password");
            if (passInput.type === "password") {
                passInput.type = "text";
            } else {
                passInput.type = "password";
            }
        }
    </script>
</body>
</html>