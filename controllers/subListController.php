<?php

$subList = $_POST['subList'];
$id = $_POST['id'];

try {
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $databaseName = "bookstore2024";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $databaseName);

    if ($conn->connect_error) {
        die("خطا در اتصال به پایگاه داده: " . $conn->connect_error);
    }

    if ($id != -1) {
        $sql = "UPDATE categories SET catName = '$subList' where id=$id";
        if ($conn->query($sql) === TRUE) {
            Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/sub-list.php?msg=با موفقیت ویرایش شد.");
        } else {
            Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/sub-list.php?error=مشکلی در ویرایش پیش آمد.");
        }
    } else {
        $sql = "SELECT * FROM categories WHERE catName='$subList'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/sub-list.php?error=این موضوع قبلا ثبت شده است!");
        } else {
            $sql = "insert into categories (catName) values ('$subList')";
            if ($conn->query($sql) === TRUE) {
                Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/sub-list.php?msg=با موفقیت ثبت شد.");
            } else {
                Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/sub-list.php?error=مشکلی در ثبت پیش آمد.");
            }
        }
    }
} catch (Exception $ex) {
    Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/sub-list.php?error=" . $ex->getMessage());
}
