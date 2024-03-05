<?php
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
$newPassword2 = $_POST['newPassword2'];
$userName = $_POST['userName'];

if ($newPassword != $newPassword2) {
    header("Location: http://localhost/php_bookstore_2024/ui-dashboard/password.php?error= رمز عبور جدید و تکرار آن با هم برابر نیستند!");
} else
    try {
        $servername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $databaseName = "bookstore2024";

        $conn = new mysqli($servername, $dbUsername, $dbPassword, $databaseName);

        if ($conn->connect_error) {
            die("خطا در اتصال به پایگاه داده: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE userName='$userName'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $userInDB = $result->fetch_assoc();
            if (password_verify($oldPassword, $userInDB['userPassword'])) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET userPassword='$hashedPassword' where userName='$userName'";
                if ($conn->query($sql) === TRUE) {
                    Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/password.php?msg= کلمه عبور با موفقیت تغییر کرد!");
                }
            } else {
                Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/password.php?error= کلمه عبور قدیمی را درست وارد کنید!");
            }

        }
    } catch (Exception $ex) {
        Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/password.php?error= خطایی رخ داده -> " . $ex->getMessage());
    }