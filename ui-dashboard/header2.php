<?php session_start() ?>
<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فرشگاه کتاب</title>
    <link rel="stylesheet" href="../bs/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../bs/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../styles/myStyle2.css">
    <script src="../bs/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
if (!isset($_SESSION['user']))
    header('Location: http://localhost/php_bookstore_2024/')
?>
<div class="container fluid">
    <div class="row">
        <div class="col-sm-2 sidebar">
            <a href="../index.php" class="text-white">
                <h3>
                    <i class="bi bi-book logo"></i>
                    فروشگاه کتاب
                </h3>
            </a>
            <ul>
                <li><a href="home.php"> پیشخوان </a></li>
                <li><a href="profile.php"> پروفایل </a></li>
                <li><a href="password.php"> تغییر کلمه عبور </a></li>
                <li><a href="my-orders.php"> سفارشات من </a></li>
                <li><a href="book-list.php"> مدیریت کتاب ها </a></li>
                <li><a href="sub-list.php"> مدیریت موضوعات </a></li>
                <li><a href="user-list.php"> مدیریت مشتریان </a></li>
                <li><a href="order-list.php"> مدیریت سفارشات </a></li>
            </ul>
        </div>
        <div class="col sm-10 main">
            <div class="header">
                <?= $page_title ?>
                <span class="user">
                   نام کاربری:  <?= $_SESSION['user'] ?>
                <a class="text-danger" href="../controllers/logoutController.php">
                    <i class="bi bi-box-arrow-right"></i>
                    خروج
                </a>
                </span>
            </div>
            <div class="content">