<?php
//include("login/hitelesit.php"); //tartalmazza a hitelesit.php fájlt az összes belépési oldalon 
session_start();
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Repcsimotorok.hu - Termékbemutatás</title>
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

    require('./shop/sql.php');
    require('./shop/fuggveny.php');
    $conn = nyit();
    if (isset($_POST["azonosit"]) && $_POST["azonosit"] != "") {
        $ID          = $_POST["azonosit"];
        $kepek       = kepek_sql($ID);
        $cime        = [];

        while ($sor2 = mysqli_fetch_array($kepek)) {
            $cime[]  = $sor2["path"];
        }

        $eredmeny    = teljesTartalom($ID);
        $sor         = mysqli_fetch_array($eredmeny);
        $gepek       = [];
        $gepek[]     = explode(',', $sor["gep"]);
        $reszletek[] = explode(',', $sor["extras"]);
    ?>

        <!-- Open Content -->
        <section class="bg-light">
            <div class="container pb-5">
                <div class="row">
                    <div class="col-lg-5 mt-5">
                        <div class="card mb-3">
                            <img class="card-img img-fluid" src="./assets/product/<?php print($sor["path"]); ?>" alt="<?php print($sor["alt"]); ?>" id="product-detail">
                        </div>
                        <div class="row">

                            <div class="col-1 align-self-center">
                                <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                    <i class="text-dark fas fa-chevron-left"></i>
                                    <span class="sr-only">Előző</span>
                                </a>
                            </div>

                            <!--Start kis képek-->
                            <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                                <!--Start Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">

                                    <!--First slide-->
                                    <?php
                                    if (count($cime) > 2) {
                                    ?>
                                        <div class="carousel-item active">
                                            <div class="row">
                                                <?php
                                                for ($j = 0; $j < 3; $j++) {
                                                ?>
                                                    <div class="col-4">
                                                        <a href="#">
                                                            <img class="card-img img-fluid" src="./assets/product/<?php print($cime[$j]); ?>" alt="Product Image 1">
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="row">
                                                <?php
                                                for ($x = 3; $x < count($cime); $x++) {
                                                ?>
                                                    <div class="col-4">
                                                        <a href="#">
                                                            <img class="card-img img-fluid" src="./assets/product/<?php print($cime[$x]); ?>" alt="Product Image 1">
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="carousel-item active">
                                            <div class="row">
                                                <?php
                                                for ($y = 0; $y < count($cime); $y++) {
                                                ?>
                                                    <div class="col-4">
                                                        <a href="#">
                                                            <img class="card-img img-fluid" src="./assets/product/<?php print($cime[$y]); ?>" alt="Product Image 1">
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!--kis képek vége-->

                            <div class="col-1 align-self-center">
                                <a href="#multi-item-example" role="button" data-bs-slide="next">
                                    <i class="text-dark fas fa-chevron-right"></i>
                                    <span class="sr-only">Következő</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- Minden kép vége -->

                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <form action="kosar.php" method="POST">
                                    <input type='hidden' name='code' value="<?php print($sor["t_id"]); ?> " />
                                    <h1 class="h2"><?php print($sor["nev"]); ?></h1>
                                    <p class="h3 py-2"><?php print(number_format(($sor["ar"]), 2, ', ', ' ')); ?> &#8364;</p>

                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <h5>Kategória: </h5>
                                        </li>
                                        <li class="list-inline-item">
                                            <p class="text-danger"><strong><?php print($sor["kat_nev1"]); ?></strong></p>
                                        </li>
                                        <li class="list-inline-item">
                                            <p class="text-danger"><strong> - <?php print($sor["kat_nev2"]); ?></strong></p>
                                        </li>
                                    </ul>

                                    <h5>Műszaki adatok:</h5>
                                    <ul>
                                        <li>Tolóerő:&ensp; <?php print($sor["toloero"]); ?></li>
                                        <li>Teljesítmény:&ensp; <?php print($sor["teljesit"]); ?></li>
                                        <li>Kétáramúság foka <a href="https://hmn.wiki/hu/Bypass_ratio" target="blank">(BPR):</a><br>&emsp; &emsp; <?php print($sor["bpr"]); ?></li>
                                        <li>Nyomásarány:&ensp; <?php print($sor["nyomasarany"]); ?></li>
                                        <li>Hossz:&ensp; <?php print($sor["hossz"]); ?></li>
                                        <li>Átmérő:&ensp; <?php print($sor["ventilator_atmero"]); ?></li>
                                        <li>Súly:&ensp; <?php print($sor["suly"]); ?></li>
                                    </ul>
                                    <h5>Alkalmazása: </h5>
                                    <ul class="list-unstyled">
                                        <?php
                                        for ($i = 0; $i < count($gepek[0]); $i++) {
                                            echo '<li class="text-danger"><strong>' . $gepek[0][$i] . '</strong></li>';
                                        }
                                        ?>
                                    </ul>

                                    <h5>Részletek:</h5>
                                    <ul class="list-unstyled pb-3">
                                        <?php
                                        for ($i = 0; $i < count($reszletek[0]); $i++) {
                                            echo '<li>' . $reszletek[0][$i] . '</li>';
                                        }
                                        ?>
                                    </ul>

                                    <h5>Leírás:</h5>
                                    <p><?php print($sor["descript"]); ?></p>

                                    <div class="row">
                                        <div class="col-auto">
                                            <ul class="list-inline pb-3">
                                                <li class="list-inline-item text-right">
                                                    Mennyiség:
                                                    <input type="hidden" name="mennyiseg" id="product-quanity" value="1" max="6">
                                                </li>
                                                <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                                <li class="list-inline-item"><span style="font-size: 20px;" class="badge bg-secondary" id="var-value">1</span></li>
                                                <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col d-grid">
                                            <button class="btn btn-success btn-lg"><a class="text-white" href="shop.php">Vásárlás folytatása</a> </button>
                                        </div>
                                        <div class="col d-grid">
                                            <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">Kosárba</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <?php
                            $nev  = $sor["nev"];
                            $kod  = $sor["t_id"];
                            $ar   = $sor["ar"];
                            $kep  = $sor["path"];
                            $kat1 = $sor["kat_nev1"];
                            $kat2 = $sor["kat_nev2"];
                            
                            //$kosarArray = [];
                            $kosarArray = array(
                                'nev'  => $nev,
                                'kod'  => $kod,
                                'ar'   => $ar,
                                'kep'  => $kep,
                                'kat1' => $kat1,
                                'kat2' => $kat2,
                            );                            

                            if (empty($_SESSION["kosar_tartalma"])) {
                                $_SESSION["kosar"] = $kosarArray;
                                $_SESSION["status"] = "A<small>(z)</small> '" . $nev . "' turbina hozzáadva a kosár tartalmához.";

                            } else {
                              
                                if (in_array($kod, $_SESSION["kosar_tartalma"])) {
                                    $_SESSION["status"] = "A kosár már tartalmazza ezt a terméket: " . $nev;
                                    unset($_SESSION["kosar"]);
                                                                
                                } else {
                                    $_SESSION["kosar"] = $kosarArray;
                                    $_SESSION["status"] = "A<small>(z)</small> '" . $nev . "' turbina hozzáadva a kosár tartalmához.";
                                   
                                }
                            }
                            ?>
                        </div>

                    </div>

                <?php
            }
           
                ?>

                </div>
            </div>
        </section>

        <?php
        include('shop/product_carousel.php');
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

        <!-- Start Slider Script -->
        <script src="assets/js/slick.min.js"></script>
        <script>
            $('#carousel-related-product').slick({
                infinite: true,
                arrows: false,
                slidesToShow: 4,
                slidesToScroll: 3,
                dots: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 3
                        }
                    }
                ]
            });
        </script>
        <!-- End Slider Script -->

</body>

</html>