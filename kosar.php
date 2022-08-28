<?php
session_start();

$status = "";
if (isset($_POST['action']) && $_POST['action'] == "torol") {
    if (!empty($_SESSION["vasarolt_ossz"]) && count($_SESSION["vasarolt_ossz"]) !== null) {

        $meddig = count($_SESSION["vasarolt_ossz"]);
        for ($i = 0; $i < $meddig; $i++) {
            if (isset($_SESSION["vasarolt_ossz"][$i])) {
                foreach ($_SESSION["vasarolt_ossz"][$i] as $key => $value) {
                    if ($_POST["kod"] == $value) {
                        unset($_SESSION["vasarolt_ossz"][$i]);
                    }
                    if (empty($_SESSION["vasarolt_ossz"]))
                        unset($_SESSION["vasarolt_ossz"]);
                }
            }
        }

        foreach ($_SESSION["kosar_tartalma"] as $kulcs => $ertek) {

            if ($_POST["kod"] == $ertek) {
                unset($_SESSION["kosar_tartalma"][$kulcs]);
            }

            if (count($_SESSION["kosar_tartalma"]) === 0) {
                unset($_SESSION["vasarolt_ossz"]);
                unset($_SESSION["teljes_osszeg"]);
                $teljes_osszeg = 0;
                $egy_termek["kod"]       = '';
                $egy_termek["nev"]       = '';
                $egy_termek["ar"]        = '';
                $egy_termek["kep"]       = '';
                $egy_termek["kat1"]      = '';
                $egy_termek["kat2"]      = '';
                $egy_termek["mennyiseg"] = '';
                $egy_termek["fizetni"]   = '';
            }
        }
    }   
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Repcsimotorok - Kosár tartalma</title>
    <style>
        body {
            text-align: center;
        }
        main {
            width: 85%;
            padding: 0.4vw;
            background: linear-gradient(to right, #ffba66 0%, beige 100%);
            margin: 10px auto;
            border: thin solid aqua;
            border-radius: 8px;
            box-shadow: 6px 8px 6px lavender;
        }
        hr {
            width: 60%;
            color: #aaa;
        }
        a {
            text-decoration: none;
            color: #444;
        }
        a:hover {
            color: navy;
        }
    </style>
</head>

<body>
    <?php
    include('html/navig.php');
    ?>
    <main>
        <h3 class="h3">Kosár tartalma</h3>

        <?php
        if (isset($_POST['mennyiseg']) && $_POST['mennyiseg'] != "") {
            if (isset($_SESSION["status"])) {
                echo '<h4 text-dark text-decoration-none m-5">' . $_SESSION["status"] . '</h4>';
            }
        }
        if (!empty($_SESSION["kosar"])) {
            //include("./login/hitelesit.php"); //tartalmazza a hitelesit.php fájlt az összes belépési oldalon 

            $egy_termek["kod"]       = $_SESSION["kosar"]["kod"];
            $egy_termek["nev"]       = $_SESSION["kosar"]['nev'];
            $egy_termek["ar"]        = $_SESSION["kosar"]['ar'];
            $egy_termek["kep"]       = $_SESSION["kosar"]['kep'];
            $egy_termek["kat1"]      = $_SESSION["kosar"]['kat1'];
            $egy_termek["kat2"]      = $_SESSION["kosar"]['kat2'];
            $egy_termek["mennyiseg"] = $_POST['mennyiseg'] * 100;
            $egy_termek["fizetni"]   = $_POST['mennyiseg'] * $_SESSION["kosar"]["ar"];

            $_SESSION["vasarolt_ossz"][] = $egy_termek;
            $_SESSION["kosar_tartalma"][] = $_SESSION["kosar"]["kod"];

            echo '<h4> A kosár ' . count($_SESSION["kosar_tartalma"]) . ' darab terméket tartalmaz:</h4>';
            unset($_SESSION["kosar"]);
        }
        ?>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            $teljes_osszeg = 0;
            if (isset($_SESSION["vasarolt_ossz"])) {

                foreach ($_SESSION["vasarolt_ossz"] as $turbi) {
                    $teljes_osszeg = $teljes_osszeg + $turbi["fizetni"];
            ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="./assets/product/<?php print($turbi["kep"]); ?>" class="card-img-top" alt="<?php print($turbi["kep"]); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php print($turbi["kod"]); ?></h5>
                                <h5 class="card-title"><?php print($turbi["nev"]); ?></h5>
                                <p class="card-text"><?php print($turbi["kat1"] . " - " . $turbi["kat2"]); ?></p>
                                <p>Egységára:<br> <?php print(number_format(($turbi["ar"]), 2, ', ', ' ')); ?> &#8364;</p>
                                <p>Megrendelt mennyiség:<br>
                                <h4> <?php print(($turbi["mennyiseg"]) / 100); ?> db.</h4>
                                </p>
                            </div>
                            <p>Fizetendő összeg:</p>
                            <h4><?php print(number_format(($turbi["fizetni"]), 2, ', ', ' ')); ?> &#8364;</h4>
                            <div class="card-footer">
                                <form method='POST' action=''>
                                    <input type='hidden' name='kod' value="<?php echo $turbi["kod"]; ?>" />
                                    <input type='hidden' name='action' value="torol" />
                                    <button type='submit' class='torol'>Törlés a kosárból</button>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                }
                $_SESSION["teljes_osszeg"] = $teljes_osszeg;
                
            } else {
                echo '<h3 class="h3">A kosár üres</h3>';
            }
            ?>
        </div>
        <hr>
        <?php
        if (isset($_SESSION["teljes_osszeg"])) {
            echo '<div><h3 class="h3">Az összesen fizetendő összeg: ' . number_format(($_SESSION["teljes_osszeg"]), 2, ', ', ' ') . ' &#8364;</h3></div>';
        } ?>
        <button onclick="location.href='shop.php'" type="button" class="btn btn-info p-3 mt-2">
            <a class="text-dark" href="shop.php">VÁSÁRLÁS FOLYTATÁSA</a>
        </button>
        &ensp;
        <button onclick="location.href='login/vedve.php'" type="button" class="btn btn-primary p-3 mt-2">
            <a class="text-white" href="login/vedve.php">TOVÁBB A PÉNZTÁRHOZ</a>
        </button>
        <?php $_SESSION["vevo"] = "ok"; ?>
    </main>
    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>