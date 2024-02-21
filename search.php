<?php include('header.php'); ?>

    <h1 class="text-center alert alert-secondary">
        جستجو!!!
        <?php
        if (isset($_GET['cat']))
            print $_GET['cat'];
        ?>
    </h1>

<?php include('footer.php'); ?>