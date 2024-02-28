<?php
$page_title = "پروفایل";

include('header2.php'); ?>

<?php
$userName = $_SESSION['user'];

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$databaseName = "bookstore2024";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $databaseName);

if ($conn->connect_error) {
    die("خطا در اتصال به پایگاه داده: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE username='$userName'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $userInDB = $result->fetch_assoc();
    ?>
    <div class="card">
        <div class="card-header">
            <h2 class="text-center"><?= $userInDB['firstName'] . ' ' . $userInDB['lastName'] ?></h2>
        </div>
        <div class="card-body row align-items-center">
            <img class="w-25" src="../userPhotos/<?= $userInDB['userProfile'] ?>" alt="<?= $userInDB['userName'] ?>">
            <div class="col">
                <p>نام: <?= $userInDB['firstName'] ?></p>
                <p>نام خانوادگی: <?= $userInDB['lastName'] ?></p>
                <p>شماره تلفن: <?= $userInDB['phone'] ?></p>
                <p>ایمیل: <?= $userInDB['email'] ?></p>
                <p> تاریخ ثبت نام: <span dir="ltr"><?= $userInDB['registerDate'] ?></span></p>
            </div>
        </div>
    </div>
<?php } else { ?>
    <p class="alert alert-warning"> مشکلی در نمایش اطلاعات پیش آمد.</p>
<?php } ?>

<?php include('footer2.php'); ?>