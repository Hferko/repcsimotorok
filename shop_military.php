<?php
//include("login/hitelesit.php"); //tartalmazza a hitelesit.php fájlt az összes belépési oldalon 
session_start();

?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Repcsimotorok.hu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="assets/img/pngegg.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
</head>

<body>
    <?php
    include('html/navig.php');
    ?>

    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <?php
            include('./shop/side_nav.php');
            ?>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-10">
                        <ul class="list-inline shop-top-menu p-3">
                            <li class="list-inline-item">
                                <p class="h3 text-dark text-decoration-none mr-3">Katonai gépek turbinái</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4">

                    <?php

                    require('./shop/sql.php');
                    require('./shop/fuggveny.php');
                    $conn = nyit();
                    $limit = 9;

                    if (isset($_GET["oldal"])) {
                        $aktual_oldal  = $_GET["oldal"];
                    } else {
                        $aktual_oldal = 1;
                    };
                    $kezdes = ($aktual_oldal - 1) * $limit;

                    $sorokSzama = sorokSzama_katonai();
                    $eredmeny = tablaTartalom_katonai($kezdes, $limit);

                    if (!$eredmeny) {
                        print(mysqli_error($conn) . ' ' . mysqli_errno($conn));
                    } else {
                        tablaRajz($eredmeny);
                        pager_katonai($limit, $aktual_oldal, $sorokSzama);
                    }

                    ?>
                </div>

            </div>
        </div>
        <!-- End Content -->
        <?php
        include('./shop/brands.php');
        ?>

        <?php
        include('html/footer.php');
        mysqli_close($conn);
        ?>

        <!-- Start Script -->
        <script src="assets/js/jquery-1.11.0.min.js"></script>
        <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/templatemo.js"></script>
        <script src="assets/js/custom.js"></script>
        <!-- End Script -->
</body>

</html>