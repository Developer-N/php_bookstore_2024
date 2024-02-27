<?php
session_start();

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$photoName = $_FILES["photo"]["name"];
$photoType = $_FILES["photo"]["type"];
$photoSize = $_FILES["photo"]["size"];
$photoTempName = $_FILES["photo"]["tmp_name"];
move_uploaded_file($photoTempName, "../userPhotos/$photoName");

try {
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $databaseName = "bookstore2024";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $databaseName);

    if ($conn->connect_error) {
        die("خطا در اتصال به پایگاه داده: " . $conn->connect_error);
    }
    $date = date('Y-m-d H:i:s');
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "insert into users (firstName, lastName, phone, email, userName, userPassword, userProfile, registerDate) 
values ('$firstName','$lastName','$phone','$email','$username','$hashedPassword','$photoName','$date')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['user'] = $username;
        Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/home.php");
    } else {
        Header("Location: http://localhost/php_bookstore_2024/register.php?error=registerError");
    }

} catch (Exception $ex) {
    Header("Location: http://localhost/php_bookstore_2024/register.php?error=" . $ex->getMessage());
}