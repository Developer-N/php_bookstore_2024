<?php include('header.php'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">فرم ثبت نام</div>
                <div class="card-body">

                    <form action="controllers/registerController.php" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="firstName" class="form-label">نام</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>

                        <div class="mb-3">
                            <label for="lastName" class="form-label">نام خانوادگی</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">شماره تلفن</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">ایمیل</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">نام کاربری</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">رمز عبور</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">عکس پروفایل</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept=".jpeg, .jpg, .png">
                        </div>

                        <button type="submit" class="btn btn-primary">ثبت نام</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

