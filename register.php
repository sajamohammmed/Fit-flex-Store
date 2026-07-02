<?php
include 'db.php'; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('اسم المستخدم مسجل مسبقاً! اختر اسماً آخر.');</script>";
    } else {
        $insertQuery = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'user')";
        
        if (mysqli_query($conn, $insertQuery)) {
            $_SESSION['username'] = $username;
            echo "<script>
                    alert('تم إنشاء الحساب بنجاح!');
                    window.location.href = 'FitFlexStore.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('حدث خطأ أثناء التسجيل، حاول مرة أخرى.');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit Flex Store - إنشاء حساب</title>
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
            background: linear-gradient(135deg, #330808 0%, #2b043e 100%); /* نفس الباك جراوند الموف الفخم تبع الـ index */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px 0;
        }

        .register-card {
            background-color: #f8f9fa;
            width: 100%;
            max-width: 450px;
            padding: 35px 30px;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        .logo-text {
            color: #e0663a; 
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 5px;
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
            margin-bottom: 18px;
            text-align: right;
        }

        .form-group label {
            display: block;
            color: #333333;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 6px;
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
            margin-top: 15px;
            transition: background 0.2s, transform 0.1s;
        }

        .submit-btn:hover {
            background-color: #ee660c;
        }

        .submit-btn:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

    <div class="register-card">
        <h1 class="logo-text">Fit Flex Store</h1>
        <p class="subtitle">متجر متكامل لمستلزمات الجيم والتغذية الرياضية</p>

        <div class="tab-container">
            <button class="tab-btn tab-inactive" onclick="location.href='login.php'">تسجيل الدخول</button>
            <button class="tab-btn tab-active">حساب جديد</button>
        </div>
        <form action="register.php" method="POST">
            
            <div class="form-group">
                <label>الاسم الكامل</label>
                <input type="text" name="full_name" class="form-control" placeholder="محمد أحمد" required>
            </div>

            <div class="form-group">
                <label>اسم المستخدم</label>
                <input type="text" name="username" class="form-control" placeholder="اختر اسم مستخدم" required>
            </div>

            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
            </div>

            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" class="form-control" placeholder="6 أحرف على الأقل" required>
            </div>

            <button type="submit" class="submit-btn">إنشاء حساب</button>
        </form>
    </div>

</body>
</html>