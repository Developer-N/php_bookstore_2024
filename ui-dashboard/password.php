<?php
$page_title = "تغییر کلمه عبور";

include('header2.php'); ?>
    <div class="container-fluid d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-header text-center">فرم تغییر کلمه عبور</div>
            <div class="card-body">
                <form method="post" action="../controllers/passwordChangeController.php">

                    <input type="hidden" name="userName" value="<?= $_SESSION['user'] ?>">

                    <div class="mb-3">
                        <label for="oldPassword" class="form-label">کلمه عبور قدیمی</label>
                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                    </div>

                    <div class="mb-3">
                        <label for="newPassword" class="form-label">کلمه عبور جدید</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>

                    <div class="mb-3">
                        <label for="newPassword2" class="form-label">تکرار کلمه عبور جدید</label>
                        <input type="password" class="form-control" id="newPassword2" name="newPassword2" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
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

            </div>
        </div>

    </div>


<?php include('footer2.php'); ?>