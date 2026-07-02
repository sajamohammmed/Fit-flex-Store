<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "fitflexstore";
$conn = new mysqli($host, $user, $password, $dbname);

if($conn-> connect_error){
    die("فشل الاتصال بقاعدة بياناتك ".$conn-> connect_error);
}
$conn-> set_charset("utf8mb4");













