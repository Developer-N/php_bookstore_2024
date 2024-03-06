<?php
$page_title = "مدیریت موضوعات";

include('header2.php'); ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore2024";

$isDBConnected = false;
$conn = null;
$isEditEnabled = false;
$cat = null;
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if (!$conn->connect_error) {
        $isDBConnected = true;
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM categories where id = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $isEditEnabled = true;
            $cat = mysqli_fetch_assoc($result);
        }
    }

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $delSql = "delete from categories where id = $id";
        if ($conn->query($delSql) === TRUE) { ?>
            <p class="alert-warning alert-success">با موفقیت حذف شد.</p>
        <?php } else { ?>
            <p class="alert alert-warning"> <?= $conn->error ?>مشکلی در حذف پیش آمد.</p>
        <?php }
    }
} catch (Exception $ex) { ?>
    <p class="alert alert-warning">خطا در اتصال به پایگاه داده: یه جای کار میلنگه، ببین زمپ خاموشه؟؟ نکنه پایگاه داده رو
        پاک
        کردی یا اطلاعات وصل شدن به پایگاه داده
        رو دست زدی؟ 🤨🤨</p>
<?php } ?>

    <div class="container-fluid d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-header text-center">فرم مدیریت موضوعات</div>
            <div class="card-body">
                <form method="post" action="../controllers/subListController.php">
                    <input type="hidden" name="id"
                           value="<?php if ($isEditEnabled) print $cat['id']; else print -1; ?>">
                    <div class="mb-3">
                        <label for="subList" class="form-label">موضوع</label>
                        <input type="text" class="form-control" id="subList" name="subList"
                               value="<?php if ($isEditEnabled && $cat != null) print $cat['catName']; ?>" required>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn btn-primary"
                               value="<?php if ($isEditEnabled) print "ویرایش"; else print "اضافه کردن"; ?>"
                            <?php if (!$isDBConnected) print "disabled" ?>>
                    </div>
                </form>

                <?php
                if (isset($_GET['error'])) {
                    ?>
                    <p class="m-2 alert alert-warning"><?= $_GET['error'] ?></p>
                <?php } ?>

                <?php
                if (isset($_GET['msg'])) {
                    ?>
                    <p class="m-2 alert alert-success"><?= $_GET['msg'] ?></p>
                <?php } ?>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">موضوع</th>
                        <th scope="col">کد</th>
                        <th scope="col" class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if ($isDBConnected && $conn != null) {
                        $sql = "SELECT * FROM categories";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $index = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $index++ ?></td>
                                    <td> <?= $row['catName'] ?></td>
                                    <td> <?= $row['id'] ?></td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="sub-list.php?del=<?= $row['id'] ?>"><i
                                                        class="bi bi-trash-fill text-danger"></i></a>
                                            <a href="sub-list.php?edit=<?= $row['id'] ?>"><i
                                                        class="bi bi-pencil-square text-warning"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                            $conn->close();
                        } else { ?>
                            <tr>
                                <td colspan="4" class="text-center"> هیچ موضوعی ثبت نشده است.</td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="4" class="text-center"> مشکلی در ارتباط با پایگاه داده پیش آمد.</td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>

<?php include('footer2.php'); ?>