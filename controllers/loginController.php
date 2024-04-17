<?php
session_start();
$userName = $_POST['username'];
$userPassword = $_POST['password'];
try {
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $databaseName = "bookstore2024";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $databaseName);

    if ($conn->connect_error) {
        die("خطا در اتصال به پایگاه داده: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username= ?");
    $stmt->bind_param('s',$userName);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $userInDB = $result->fetch_assoc();
        if (password_verify($userPassword, $userInDB['userPassword'])) {
            $_SESSION['user'] = $userInDB['userName'];
            Header("Location: http://localhost/php_bookstore_2024/");
        } else {
            Header("Location: http://localhost/php_bookstore_2024/login.php?error= رمز عبور اشتباه است!");
        }
    } else {
        Header("Location: http://localhost/php_bookstore_2024/login.php?error=نام کاربری اشتباه است!");
    }
} catch (Exception $ex) {
    Header("Location: http://localhost/php_bookstore_2024/login.php?error=" . $ex->getMessage());
}

?>