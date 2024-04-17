<?php
$page_title = "مدیریت کتاب ها";

include('header2.php'); ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore2024";

$isDBConnected = false;
$conn = null;
$isEditEnabled = false;
$book = null;
$categories = null;

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if (!$conn->connect_error) {
        $isDBConnected = true;
    }

    $sql = "SELECT * FROM categories";
    $categories = array();
    $cats = $conn->query($sql);
    if ($cats) {
        while ($row = $cats->fetch_assoc())
            $categories[] = $row;
        $cats->free_result();
    }
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM books where id = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $isEditEnabled = true;
            $book = mysqli_fetch_assoc($result);
        }
    }

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $delSql = "delete from books where id = $id";
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
        <div class="card">
            <div class="card-header text-center">فرم مدیریت کتاب</div>
            <div class="card-body container overflow-hidden">
                <form method="post" action="../controllers/bookListController.php" enctype="multipart/form-data">
                    <input type="hidden" name="id"
                           value="<?php if ($isEditEnabled) print $book['id']; else print -1; ?>">
                    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                        <div class="mb-3 col">
                            <label for="bookName" class="form-label">نام کتاب</label>
                            <input type="text" class="form-control" id="bookName" name="bookName"
                                   value="<?php if ($isEditEnabled && $book != null) print $book['bookName']; ?>"
                                   required>
                        </div>
                        <div class="mb-3 col">
                            <label for="author" class="form-label">نویسنده</label>
                            <input type="text" class="form-control" id="author" name="author"
                                   value="<?php if ($isEditEnabled && $book != null) print $book['author']; ?>"
                                   required>
                        </div>
                        <div class="mb-3 col">
                            <label for="isbn" class="form-label">شابک</label>
                            <input type="text" class="form-control" id="isbn" name="isbn"
                                   value="<?php if ($isEditEnabled && $book != null) print $book['isbn']; ?>">
                        </div>
                        <div class="mb-3 col">
                            <label for="publisher" class="form-label">انتشارات</label>
                            <input type="text" class="form-control" id="publisher" name="publisher"
                                   value="<?php if ($isEditEnabled && $book != null) print $book['publisher']; ?>"
                                   required>
                        </div>
                        <div class="mb-3 col">
                            <label for="coverPhoto" class="form-label">عکس جلد</label>
                            <input type="file" class="form-control" id="coverPhoto" name="coverPhoto"
                                <?php if ($isEditEnabled) print 'disabled'; ?>
                                   accept="image/*">
                        </div>
                        <div class="mb-3 col">
                            <label for="pageNumber" class="form-label">تعداد صفحه</label>
                            <input type="number" class="form-control" id="pageNumber" name="pageNumber"
                                   value="<?php if ($isEditEnabled && $book != null) print $book['pageNumber']; ?>"
                                   min="1">
                        </div>
                        <div class="mb-3 col">
                            <label for="coverType" class="form-label">نوع جلد</label>
                            <input type="text" class="form-control" id="coverType" name="coverType"
                                   value="<?php if ($isEditEnabled && $book != null) print $book['coverType']; ?>">
                        </div>
                        <div class="mb-3 col">
                            <label for="bookCount" class="form-label">تعداد کتاب</label>
                            <input type="number" class="form-control" id="bookCount" name="bookCount"
                                   value="<?php if ($isEditEnabled && $book != null) print $book['bookCount']; ?>"
                                   min="0">
                        </div>

                        <div class="mb-3 col">
                            <label for="category" class="form-label">موضوع</label>
                            <select class="form-select" id="category" name="category">
                                <?php foreach ($categories as $cat) { ?>
                                    <option value="<?= $cat['id'] ?>" <?php if ($book != null && $book['categoryID'] == $cat['id']) echo "selected" ?>> <?= $cat['catName'] ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 col">
                        <label for="extra" class="form-label">توضیحات</label>
                        <textarea type="text" class="form-control" id="extra"
                                  name="extra"><?php if ($isEditEnabled && $book != null) print $book['extra']; ?></textarea>
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
                <div class="container m-2">

                    <?php
                    if ($isDBConnected && $conn != null) {
                        $sql = "SELECT * FROM books";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $index = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="card m-2">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-around align-items-center">
                                            <h2 class="text-center"><?= $row['bookName'] ?></h2>
                                            <a href="book-list.php?del=<?= $row['id'] ?>"><i
                                                        class="bi bi-trash-fill text-danger h2"></i></a>
                                            <a href="book-list.php?edit=<?= $row['id'] ?>"><i
                                                        class="bi bi-pencil-square text-warning h2"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body row align-items-center">
                                        <img class="w-25" src="../bookPhotos/<?= $row['coverPhoto'] ?>"
                                             alt="<?= $row['bookName'] ?>">
                                        <div class="col">
                                            <p>نویسنده: <?= $row['author'] ?></p>
                                            <p>شابک: <?= $row['isbn'] ?></p>
                                            <p>انتشارات: <?= $row['publisher'] ?></p>
                                            <p>تعداد صفحه: <?= $row['pageNumber'] ?></p>
                                            <p> نوع جلد: <?= $row['coverType'] ?></p>
                                            <p> موضوع: <?php
                                                foreach ($categories as $category)
                                                    if ($category['id'] == $row['categoryID'])
                                                        echo $category['catName']
                                                ?></p>
                                            <p> تعداد کتاب: <?= $row['bookCount'] ?></p>
                                            <p> تاریخ ثبت کتاب: <?= $row['insertDate'] ?></p>
                                            <p> توضیحات: <?= $row['extra'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            $conn->close();
                        } else { ?>
                            <p class="text-center alert alert-warning"> هیچ کتابی ثبت نشده است.</p>
                        <?php }
                    } else { ?>
                        <p class="text-center alert alert-danger"> مشکلی در ارتباط با پایگاه داده پیش آمد.</p>
                    <?php } ?>

                </div>

            </div>
        </div>
    </div>

<?php include('footer2.php'); ?>