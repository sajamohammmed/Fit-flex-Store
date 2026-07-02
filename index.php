<?php
   session_start();
   
?>



<!DOCTYPE html>
<html lang="ar" dir=rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit Flex Store </title>
    <style>
        maring: 0;
        padding: 0;
        box-izing: border-box
        font-family: 'Segoe UT' , Tahom , Geneva , Verdana , sans_serif;

        body{
            background-color: #111;
            color: #ffffff
            overflow-hidden;
        }

        .welcome-container{
            display: flex;
            height: 100vh;
            width: 100%;
            flex-direction: row-reverse;
        }

        .image-section{
            flex: 1.2;
            position: relative;
            background-color: #222
            //flex-direction: row;
        }

        .image-section img{
            width:100%;
            height:100%;
            object-fit: cover;
            filter: brightness(60%);
        }

        .text-section{
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 60px;
            background: linear-gradient(135deg , #330808 0% , #2b043e 100%);
        }
        .text-section h1{
            font-size: 3.5rem;
            color: #ee660c;
            margin-bottom:20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .text-section p{
            font-size: 1.2rem;
            line-height: 1.8;
            color: #96ccd4;
            margin-bottom:40px;
            max-width: 500px;
        }

        .enter-btn{
            display: inline-block;
            width: max-content;
            padding: 14px 35px;
            background-color: #ff4a11;
            color: #ffffff;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: bold; 
            border-radius: 5px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 74, 17, 0.4);
        }

        .enter-bth:hover{
            background-color: #e03d00;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 74, 17, 0.6);
        }

        @media (max-width: 768px){
            .welcome-container{
                 flex-direction: column;}
            .image-section{
                height: 40vh; }
            .text-section{
                padding: 30px;
                align-items: center;
                text-align: center;}
            .text-section h1{
                font-size: 2.5rem;}
        }
    </style>
</head>
<body>

    <div class="welcome-container">
        <div class="image-section">
            <img src="image/start1.jpg" alt= "Gym Equipment">
        </div>

        <div class="text-section">
            <h1>Fit Flex Store</h1>
            <p>أهلاً بك في متجرك الرياضي المتكامل نحن هنا لنكون شركاءك في رحلتك نحو حياة صحية 
                وجسد رياضي مثالي حيث نسعى جاهدين لتوفير كل ما يبحث عنه الرياضيون والمبتدئون في 
                مكان واحد وبأعلى جودة ممكنة . يضم متجرنا تشكيلة واسعة ومختارة بعناية من أفضل المعدات والأدوات والأدوات 
                الرياضية الاحترافية التي تساعدك على أداء تمارينك بكفاءة عالية، بالإضافة إلى قسم خاص ومتكامل 
               ، لمكملات التغذية والبروتينات الأصلية التي تدعم أهدافك البدنية سواء كنت تسعى لبناء العضلات 
                خسارة الوزن أو رفع مستوى لياقتك البدنية . نعدك بتجربة تسوق ممتعة وسهلة من خلال تصفح 
                أقسامنا المتنوعة وإدارة سلة مشترياتك بكل سلاسة . أنضم إلينا الأن ،استكشف أفضل العروض والمنتجات وابدأ خطوتك بكل ثقة .
            </p>

            <a href="login.php" class="enter-btn">أنقر للدخول الى الموقع</a>
            
        </div>
    </div>
</body>
</html>    






