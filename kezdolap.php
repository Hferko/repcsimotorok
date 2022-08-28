<?php
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
    <!-- Slick 
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">-->
</head>

<body>
    <?php
    include('html/navig.php');
    ?>

    <!-- Start Banner -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner_img_01.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h2 class="h2 text-success"><b>Repcsimotorok</b> WEB shop</h2>
                                <h4 class="h4">A gázturbinás sugárhajtómű olyan - elsősorban repülőgépeken alkalmazott -
                                    gázturbina, amelynél a nagy sebességgel kiáramló égéstermékek reakcióereje
                                    szolgáltatja a tolóerőt. </h4>
                                <p>
                                    A jobb megismerés érdekében: <a rel="sponsored" class="text-success" href="https://aeroreport.de/en/good-to-know/how-does-a-turbofan-engine-work" target="_blank"> AEROREPORT.DE</a><br>
                                    Továbbiak: <a rel="sponsored" class="text-success" href="https://aeroreport.de/en/good-to-know/how-does-a-turbofan-engine-work-the-structure-of-an-engine" target="_blank">The Aviation magazin</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner_img_02.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h2 class="h2">Nézzen szét áruházunkban</h2>
                                <h4 class="h3">rövid határidőn belül szállítunk</h4>
                                <p>
                                    A különböző típusú motorok az alkalmazástól függően eltérő előnyöket kínálnak. Ahogy
                                    a repülés kora felvirradt, a légcsavaros dugattyús motorok kerültek előtérbe. Ma már
                                    szinte kizárólag kis- és magánrepülőgépeken találhatók ilyenek.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner_img_03.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h2 class="h2">Vásároljon nálunk</h2>
                                <h4 class="h3">Pénzvisszafizetési garancia</h4>
                                <p>
                                    Csúcstechnológia a legkisebb alkatrészig: a modern repülőgép-hajtóművek
                                    csúcskategóriás technológiai termékek, amelyeknek ellenállniuk kell az extrém
                                    körülményeknek.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
   
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h2 class="h2">Termék kategóriák</h2>
                    <p>
                        Fedezze fel jól bevált termékeinket légterének őrzéséhez, vagy felszerelésének roppant gyors
                        célbajuttatásához.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100 kezdo">
                        <a href="shop_com.php">
                            <img src="./assets/img/civil.webp" class="card-img-top" alt="Kereskedelmi repülőgép-hajtóművek">
                        </a>
                        <div class="card-body">
                            <a href="shop_com.php" class="h4 text-decoration-none text-dark">Kereskedelmi
                                repülőgép-hajtóművek</a>
                            <hr>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Széles testű Jetek</li>
                                <li class="list-group-item">Keskenytestű Jetek</li>
                                <li class="list-group-item">Üzleti repülőgépek</li>
                                <li class="list-group-item">Légcsavaros gázturbinák</li>
                                <li class="list-group-item">Helikopterek</li>
                            </ul>
                            <hr><br>
                            <p class="text-center fix"><a href="shop_com.php" class="btn btn-info">Irány a bolt</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100 kezdo">
                        <a href="shop_military.php">
                            <img src="./assets/img/katonai.webp" class="card-img-top" alt="Katonai repülőgép-hajtóművek">
                        </a>
                        <div class="card-body">

                            <a href="shop_military.php" class="h4 text-decoration-none text-dark">Katonai
                                repülőgép-<br>hajtóművek </a>
                            <hr>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Vadászrepülőgépek</li>
                                <li class="list-group-item">Helikopterek</li>
                                <li class="list-group-item">Szállító repülőgépek</li>

                            </ul>
                            <hr><br>
                            <p class="text-center fix"><a href="shop_military.php" class="btn btn-info">Irány a bolt</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100 kezdo">
                        <a href="shop_indust.php">
                            <img src="./assets/img/ipari.webp" class="card-img-top" alt="Ipari gázturbinák">
                        </a>
                        <div class="card-body">
                            <a href="shop_indust.php" class="h4 text-decoration-none text-dark">Ipari<br> gázturbinák</a>
                            <hr>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">LM2500™ széria</li>
                                <li class="list-group-item">LM6000™ széria</li>
                                <li class="list-group-item">SGT-800</li>
                            </ul>
                            <hr><br>
                            <p class="text-center fix"><a href="shop_indust.php" class="btn btn-info">Irány a bolt</a></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
   
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h2 class="h2">Kiemelt ajánlataink</h2>
                <p>
                    A kiemelt ajánlataink között megtalálja különleges termékeinket, akcióinkat, az Önnek legmegfelelőbb párosításban. Nézz meg kiemelt kategóriánk kínálatát.
                </p>
            </div>
        </div>
        <div class="card-group row">
            <?php
            require_once('db/dbfill.php');
            require_once('config.php');

            $db = $dbname;
            $conn = kapcsolat();

            $sql = "SELECT COUNT(t_id) FROM `$db`.`turbina`";
            $eredmeny = mysqli_query($conn, $sql);
            $sor = mysqli_fetch_array($eredmeny);
            $mennyi = $sor[0];

            $tomb = [];
            $set  = array_unique($tomb);

            while (count($set) < 3) {
                $tomb[] = rand(1, $mennyi);
                $set  = array_unique($tomb);
            }

            foreach ($set as $szamok) {
                $sql2 = "SELECT  turbina.t_id, turbina.nev, turbina.descript, category.kat_nev1, category.kat_nev2, images.path, images.alt, arak.ar 
                    FROM (((`$db`.`turbina` 
                    INNER JOIN category ON turbina.kat=category.kat_id)
                    INNER JOIN images ON turbina.t_id=images.t_id)
                    INNER JOIN arak ON turbina.t_id=arak.t_id)
                    WHERE turbina.t_id = $szamok AND images.alap =1;";

                $result = mysqli_query($conn, $sql2);
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-12 col-md-4 p-4 mt-3 card">
                        <div class="card-body offer">
                            <form action="shop-single.php" method="POST">
                                <input type="hidden" name="azonosit" value="<?php print($row["t_id"]); ?>">
                                <img src="./assets/product/<?php print($row["path"]); ?>" alt="<?php print($row["alt"]); ?>" class="rounded-3 img-fluid border">

                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <?php
                                        $star = rand(1, 5);
                                        for ($i = 1; $i < $star; $i++) {
                                            echo '<i class="text-warning fa fa-star"></i>';
                                        }
                                        for ($j = 1; $j < (6 - $star); $j++) {
                                            echo '<i class="text-muted fa fa-star"></i>';
                                        }
                                        ?>
                                    </li>
                                    <br>
                                    <li class="text-muted text-right"><?php print (number_format(($row["ar"]), 0, ', ', ' ')) . '&#8364;'; ?></li>
                                </ul>
                                <p class="h4 text-decoration-none text-dark"><?php print($row["nev"]); ?></p>
                                <p class="card-text">
                                    <?php print($row["kat_nev1"] . '<br>' . $row["kat_nev2"]); ?>
                                </p>
                                <p class="card-text">
                                    <?php print($row["descript"]); ?>
                                </p>
                                <p class="text-muted"><?php print (number_format(($row["ar"]), 0, ', ', ' ')) . '&#8364;'; ?></p>

                                <button class="btn btn-outline-success" style="position:absolute; bottom:10px;" type="submit" style="bottom: 20px">Lássuk a részleteket</button>
                            </form>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </section>
    <!-- End Categories of The Month -->

    <div class="video">
        <div class="article-image-hover-container">
            <video class="article-image-hover-video" autoplay="" muted="" loop="" playsinline="" data-piwik-title="Hogyan működik egy modern turbóventilátoros motor" title="Hogyan működik egy modern turbóventilátoros motor" src="./assets/img/triebwerk.mp4" type="video/mp4"></video>
        </div>
    </div>

    <?php
    include('html/footer.php');
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