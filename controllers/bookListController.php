<?php

$bookName = $_POST['bookName'];
$author = $_POST['author'];
$isbn = $_POST['isbn'];
$publisher = $_POST['publisher'];
$pageNumber = $_POST['pageNumber'];
$coverType = $_POST['coverType'];
$bookCount = $_POST['bookCount'];
$category = $_POST['category'];
$extra = $_POST['extra'];
$id = $_POST['id'];

$photoName = $_FILES["coverPhoto"]["name"];
$photoType = $_FILES["coverPhoto"]["type"];
$photoSize = $_FILES["coverPhoto"]["size"];
$photoTempName = $_FILES["coverPhoto"]["tmp_name"];

$folderPath = "../bookPhotos";

if (!file_exists($folderPath)) {
    if (!mkdir($folderPath, 0777, true)) {
        die("Failed to create folder.");
    }
}
move_uploaded_file($photoTempName, "$folderPath/$photoName");

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

    if ($id != -1) {
        //TODO complete editing
//        $sql = "UPDATE books SET catName = ?, where id=$id";
//        if ($conn->query($sql) === TRUE) {
//            Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/book-list.php?msg=با موفقیت ویرایش شد.");
//        } else {
//            Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/book-list.php?error=مشکلی در ویرایش پیش آمد.");
//        }
    } else {
        $stmt = $conn->prepare("insert into books (bookName, author, isbn, publisher, coverPhoto, pageNumber,coverType, bookCount, extra, categoryID, insertDate) values (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('sssssisisis', $bookName, $author, $isbn, $publisher, $photoName, $pageNumber, $coverType, $bookCount, $extra, $category, $date);
        if ($stmt->execute() === TRUE) {
            Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/book-list.php?msg=با موفقیت ثبت شد.");
        } else {
            Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/book-list.php?error=مشکلی در ثبت پیش آمد.");
        }
    }
} catch (Exception $ex) {
    Header("Location: http://localhost/php_bookstore_2024/ui-dashboard/book-list.php?error=" . $ex->getMessage());
}