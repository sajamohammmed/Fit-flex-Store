<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitFlex Store - حسابي</title>
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
            padding: 40px;
        }
        .profile-card {
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            border: 1px solid #222;
        }
        .profile-card h2 {
            color: #e0660c;
            margin-bottom: 25px;
            border-bottom: 2px solid #e0660c;
            padding-bottom: 10px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .form-group.full-width {
            grid-column: span 2;
        }
        .form-group label {
            font-size: 14px;
            color: #aaa;
        }
        .form-group input, .form-group select {
            padding: 12px;
            background-color: #222;
            border: 1px solid #333;
            color: white;
            border-radius: 6px;
            outline: none;
        }
        .form-group input:focus {
            border-color: #e0660c;
        }
        .btn-save {
            grid-column: span 2;
            background-color: #e0660c;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }
        .btn-save:hover {
            background-color: #b8520a;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">FitFlex Store</div>
        <ul class="sidebar-menu">
            <li><a href="FitFlexStore.php"><i class="fa-solid fa-house"></i> المتجر الرئيسي</a></li>
            <li class="active"><a href="profile.php"><i class="fa-solid fa-user"></i> حسابي الشخصي</a></li>
            <li><a href="card.php"><i class="fa-solid fa-cart-shopping"></i> السلة</a></li>
            <li><a href="login.php"><i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="profile-card">
            <h2><i class="fa-solid fa-id-card"></i> إعدادات الملف الشخصي</h2>
        <form class="form-grid" action="update_profile.php" method="POST">
              <div class="form-group full-width">
              <label>الاسم الكامل</label>
              <input type="text" name="full_name" required>
            </div>

             <div class="form-group">
             <label>العمر</label>
             <input type="number" name="age" required>
            </div>

            <div class="form-group">
               <label>الجنس</label>
               <select name="gender">
                  <option value="male">ذكر</option>
                  <option value="female">أنثى</option>
                </select>
             </div>

            <div class="form-group">
              <label>الطول (سم)</label>
              <input type="number" name="height" step="0.1" required>
            </div>

            <div class="form-group">
              <label>الوزن (كغم)</label>
              <input type="number" name="weight" step="0.1" required>
            </div>

             <button type="submit" name="save" class="btn-save">حفظ التعديلات</button>
        </form>

        </div>
    </div>

</body>
</html>