<?php include('header.php'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">ورود به سیستم</div>
                <div class="card-body">
                    <form action="#">
                        <div class="mb-3">
                            <label for="username" class="form-label">نام کاربری</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="نام کاربری خود را وارد کنید">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">رمز عبور</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور خود را وارد کنید">
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me">مرا به خاطر بسپار</label>
                        </div>
                        <button type="submit" class="btn btn-primary">ورود</button>
                        <a class="p-2 text-success" href="register.php">ثبت نام</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>