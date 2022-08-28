<?php
session_start();
include("hitelesit.php");
require('sql.php');
require('../config.php');
require('../admin/sessions.php');
$db = $dbname;
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/templatemo.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <script src="../assets/js/jquery-1.11.0.min.js"></script>
    <script src="../assets/js/bootstrap4.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Számlaadatok</title>
</head>

<body>
    <main>
        <h3>Az ön által választott termékek</h3>
        <div class="card">
            <?php
            if (isset($_SESSION["vasarolt_ossz"])) {
                $meddig = count($_SESSION["vasarolt_ossz"]);

                echo '<div class="e-table">
            <div class="table-responsive table-lg mt-3">
              <table class="table table-striped table-hover table-bordered border-info" id="tablazat">
                <thead><tr>';

                echo '<th>&#8470;</th>
                  <th>Típus</th>
                  <th>Egységára</th>
                  <th>Vásárolt mennyiség</th>
                  <th>Fizetendő</th>';
                echo "</tr> </thead> <tbody>";

                for ($i = 0; $i < $meddig; $i++) {
                    if (isset($_SESSION["vasarolt_ossz"][$i])) {
                        echo '<tr>';
                        echo '<td class="align-middle">' . ($i + 1) . ".</td>";
                        echo '<td class="align-middle"><strong>' . $_SESSION["vasarolt_ossz"][$i]["nev"] . "<strong></td>";
                        echo '<td class="text-nowrap text-end align-middle">' . number_format(($_SESSION["vasarolt_ossz"][$i]["ar"]), 2, ', ', ' ') . " &#8364; &nbsp;</td>";
                        echo '<td class="align-middle">' . ($_SESSION["vasarolt_ossz"][$i]["mennyiseg"] / 100) . " db</td>";
                        echo '<td class="text-nowrap text-end align-middle">' . number_format(($_SESSION["vasarolt_ossz"][$i]["fizetni"]), 2, ', ', ' ') . " &#8364; &nbsp;</td>";
                        echo '</tr>';
                    }
                }
                echo '</table>';
                echo '<div class="card" style="text-align:center; background:#20B2AA; color:white;">';
                echo '<p><strong>A számla végösszege:</strong></p>';
                echo '<h3>' . number_format(($_SESSION["teljes_osszeg"]), 2, ', ', ' ') . ' &#8364;</h3>';
                echo '</div>';
            } else {
                echo '<h4 class="text-danger mt-2">Üres a kosár!</h4>';
                $_SESSION['hiba'] = "Üres a kosár!";
            }
            ?>
        </div>
        <hr>
        <p><a href="../kezdolap.php"><button class="btn-info fs-4"> &ensp; Vissza a Kezdőlapra &ensp; </button></a></p>
        <h4 class="mt-5">A rendelés véglegesítéséhez kérjük töltse ki a számlához szükséges adatokat</h4>
        <a href="../kosar.php"><button>Inkább vissza a kosárhoz</button></a>
        <p>
            <?php
            $conn = nyit();
            $nev = $_SESSION['nev'];
            $sql1 = "SELECT email FROM `repcsimotor`.`felhasznalo` WHERE neve='$nev';";
            $eredmeny = mysqli_query($conn, $sql1);
            $sor = mysqli_fetch_array($eredmeny);
            $vevo_email = $sor["email"];

            // A form-hoz használt változók
            $vez_nevErr = $ker_nevErr = $telefonErr = $ir_szamErr = $telepErr = $cimErr = $kezbesitErr = $kreditErr = "";
            $vez_nev = $ker_nev = $telefon = $ir_szam = $telep = $cim = $comment = $kezbesit = $egyezik = $kredit = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (empty($_POST["vez_nev"])) {
                    $vez_nevErr = "Szükséges a vezetéknév";
                } else {
                    $vez_nev = test_input($_POST["vez_nev"]);
                }

                if (empty($_POST["ker_nev"])) {
                    $ker_nevErr = "Szükséges a keresztnév is";
                } else {
                    $ker_nev = test_input($_POST["ker_nev"]);
                }

                if (empty($_POST["telefon"])) {
                    $telefonErr = "A kézbesítésről telefonon értesítenénk önt";
                } else {
                    $telefon = test_input($_POST["telefon"]);
                }

                if (empty($_POST["ir_szam"])) {
                    $ir_szamErr = "A postacímhez szükséges az irányítószám";
                } else {
                    $ir_szam = test_input($_POST["ir_szam"]);
                    if (!preg_match("/^[0-9]{4}+$/", $ir_szam)) {
                        $ir_szamErr = "Helytelen irányítószám";
                    }
                }

                if (empty($_POST["telep"])) {
                    $telepErr = "Mely településre is küldjük?";
                } else {
                    $telep = test_input($_POST["telep"]);
                }

                if (empty($_POST["cim"])) {
                    $cimErr = "Fontos lesz az ön postacíme";
                } else {
                    $cim = test_input($_POST["cim"]);
                }

                if (empty($_POST["comment"])) {
                    $comment = "";
                } else {
                    $comment = test_input($_POST["comment"]);
                }

                if (empty($_POST["kezbesit"])) {
                    $kezbesitErr = "Hogyan is szeretné megkapni a megrendelt terméket?";
                } else {
                    $kezbesit = test_input($_POST["kezbesit"]);
                }

                if (isset($_POST["egyezik"])) {
                    $egyezik = 'Megegyezik a számlázási címmel.';
                } else {
                    $egyezik = 'Nem egyezik meg a számlázási cím és a postacím.';
                }

                if (empty($_POST["kredit"])) {
                    $kreditErr = "Milyen módon óhajt fizetni?";
                } else {
                    $kredit = test_input($_POST["kredit"]);
                }
            }

            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
                return $data;
            }
            ?></p>

        <div class="card mt-4">
            <p> Pirossal jelzett adatok kitöltése szükséges</p>
            <form class="form-horizontal templatemo-payment-form templatemo-container" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="row">
                    <div class="col">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group">
                                    Vezetéknév: <br><input class="form-control" type="text" name="vez_nev" value="<?php echo $vez_nev; ?>" placeholder="Vezetéknév" required>
                                    <span class="error"><?php echo $vez_nevErr; ?></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    Keresztnév: <br><input class="form-control" type="text" name="ker_nev" value="<?php echo $ker_nev; ?>" placeholder="Keresztnév" required>
                                    <span class="error"><?php echo $ker_nevErr; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row  mb-3">
                            <div class="col">
                                <div class="form-group">
                                    E-mail:<br> <input class="form-control" type="text" name="email" value="<?php echo $vevo_email; ?>" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    Telefonszám: <i class="fs-6"> (Minta: 20-454-2214)</i> <br><input class="form-control" type="text" name="telefon" value="<?php echo $telefon; ?>" pattern="[0-9]{2}-[0-9]{3}-[0-9]{4}" placeholder="20-425-6782" required>
                                    <span class="error"><?php echo $telefonErr; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row  mb-3">
                            <div class="col-4">
                                <div class="form-group">
                                    Irányítószám<br> <input class="form-control" type="text" name="ir_szam" value="<?php echo $ir_szam; ?>" placeholder="6900" required>
                                    <span class="error"><?php echo $ir_szamErr; ?></span>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    Település: <br><input class="form-control" type="text" name="telep" value="<?php echo $telep; ?>" placeholder="Pajkaszeg" required>
                                    <span class="error"><?php echo $telepErr; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group">
                                    Cím: <br><input class="form-control" type="text" name="cim" value="<?php echo $cim; ?>" required>
                                    <span class="error"><?php echo $cimErr; ?></span>
                                </div>
                            </div>
                        </div>
                        Egyéb megjegyzés: <textarea class="form-control" name="comment" rows="3" cols="30"><?php echo $comment; ?></textarea>
                        <br>
                        <div class="text-start mb-4 ps-4">
                            <h4>Kézbesítés módja:</h4>
                            <input type="radio" name="kezbesit" <?php if (isset($kezbesit) && $kezbesit == "futar") echo "checked"; ?> value="futar"> &nbsp; Futárszolgálat igénybevétele <br>
                            <input type="radio" name="kezbesit" <?php if (isset($kezbesit) && $kezbesit == "uzletben") echo "checked"; ?> value="uzletben"> &nbsp; Üzletünkben átveszi<br>
                            <input type="radio" name="kezbesit" <?php if (isset($kezbesit) && $kezbesit == "csomagpont") echo "checked"; ?> value="csomagpont"> &nbsp; Csomagpontra továbbítjuk
                            <span class="error"><?php echo $kezbesitErr; ?></span>
                        </div>

                        <input type="checkbox" id="egyezik" name="egyezik" value="egyezik">
                        <label for="egyezik"> A fenti cím megegyezik a számlázási címmel</label><br>
                        <hr><br>

                        <h4>
                            Kérjük adja meg milyen módon szeretne fizetni
                        </h4>
                        <div class="form-group mt-4">
                            <div class="row mb-3">
                                <div class="col-4 text-end">
                                    <label class="control-label">Fizetési lehetőségek</label>
                                </div>
                                <div class="col-8 text-start">
                                    <label class="text-start">
                                        <input type="radio" name="kredit" <?php if (isset($kredit) && $kredit == "kartya") echo "checked"; ?> value="kartya">
                                        <img src="../assets/img/visa.png" alt="visa logo">
                                        <img src="../assets/img/mastercard.png" alt="mastercard logo">
                                        <img src="../assets/img/jcb.png" alt="jcb logo">
                                        <img src="../assets/img/amex.png" alt="amex logo">
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 text-end">
                                </div>
                                <div class="col-8 text-start ">
                                    <label class="radio">
                                        <input type="radio" name="kredit" <?php if (isset($kredit) && $kredit == "paypal") echo "checked"; ?> value="paypal">
                                        <img src="../assets/img/paypal.png" alt="paypal logo">
                                        Pay Pal
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 text-end">
                                </div>
                                <div class="col-8 text-start ">
                                    <label class="radio">
                                        <input type="radio" name="kredit" <?php if (isset($kredit) && $kredit == "utanvet") echo "checked"; ?> value="utanvet">
                                        <img src="../assets/img/utanvet.png" alt="utanvet logo">
                                        Utánvétes fizetés futárnál
                                    </label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4 text-end">
                                </div>
                                <div class="col-8 text-start ">
                                    <label class="radio">
                                        <input type="radio" name="kredit" <?php if (isset($kredit) && $kredit == "utalas") echo "checked"; ?> value="utalas">
                                        <img src="../assets/img/utalas.png" alt="utalas logo">
                                        Banki átutalás
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-6 control-label">Kártyás fizetés esetén:</label>
                        </div>
                        <div class="row  mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="card_name" class="control-label">Kártyán szereplő név:</label><br>
                                    <input type="text" class="form-control" id="card_name" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="card_number" class="control-label">Kártya száma</label>
                            <input type="text" class="form-control" id="card_number" placeholder="">
                        </div>
                        <div class="row mb-3 form-group">
                            <div class="col-6">
                                <label class="control-label">Lejárat dátuma</label><br>
                                <select>
                                    <option>-</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                </select> /
                                <select>
                                    <option>-</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="cvv2" class="control-label text-left">Biztonsági kód</label><br>
                                <input type="text" maxlength="3" id="cvv2" placeholder="">
                                <img src="../assets/img/cvv2.jpg" alt="cvv2">
                            </div>
                        </div>
                    </div>
                </div>
                <p class="bg-warning"><a class="fs-5 fw-bold text-danger" href="logout.php">Elállok a vásárlástól, ürítem a kosaram</a>
                <p><a class="fs-4 fw-bold text-dark" href=" ../kezdolap.php">Kezdőlapra</a></p>
        </div>
        <input class="fs-5" type="submit" name="feldolgoz" value="&laquo; RENDELÉS LEADÁSA &raquo;">
        </form>
        <hr>
        <?php

        $maxi = utolso_adat('szamla', 'szamlaszam');        

        if (isset($_SESSION["vasarolt_ossz"]) && isset($_POST["feldolgoz"])) {

            $lekerdez = "SELECT email FROM `repcsimotor`.`felhasznalo` WHERE email = '$vevo_email';";
            $eredmeny = mysqli_query($conn, $lekerdez);
            $sor2 = mysqli_fetch_array($eredmeny);

            if (mysqli_num_rows($eredmeny) > 0) {

                $sql3 = "UPDATE repcsimotor.felhasznalo SET                
                `vez_nev` = '$vez_nev',            
                `ker_nev` = '$ker_nev',
                `telefon` = '$telefon',                 
                `ir_szam` = '$ir_szam',
                `varos`   = '$telep',
                `cim`     = '$cim'              
               WHERE felhasznalo.email = '$vevo_email';";

                if (mysqli_query($conn, $sql3)) {
                    $_SESSION['rendben'] = "A felhasználó adatai sikeresen megváltoztak";
                } else {
                    $_SESSION['fail'] = "A vásárló adatainak módosítása nem történt meg: " . mysqli_error($conn);
                }
            }
            //   ----------------------------------------
            $sql2 = "INSERT INTO `$db`.`szamla` (
                `szamlaszam`,                
                `email`,               
                `comment`,
                `t_id`,
                `tipus`,
                `egyseg_ar`,
                `mennyiseg`,
                `ossz_ar`,
                `kezbesit`,
                `teljes_osszeg`,
                `fizet_mod`,
                `created`
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ;";

            if ($stmt = mysqli_prepare($conn, $sql2)) {

                mysqli_stmt_bind_param(
                    $stmt,
                    "issisdidsdss",
                    $szamlaszam,
                    $email,
                    $comment,
                    $t_id,
                    $tipus,
                    $egyseg_ar,
                    $mennyiseg,
                    $ossz_ar,
                    $kezbesit,
                    $teljes_osszeg,
                    $fizet_mod,
                    $created
                );

                if (isset($_SESSION["vasarolt_ossz"])) {
                    for ($j = 0; $j < $meddig; $j++) {
                        $szamlaszam = $maxi + 1;
                        $email      = $vevo_email;
                        $comment    = $comment;
                        $t_id       = $_SESSION["vasarolt_ossz"][$j]["kod"];
                        $tipus      = $_SESSION["vasarolt_ossz"][$j]["nev"];
                        $egyseg_ar  = $_SESSION["vasarolt_ossz"][$j]["ar"];
                        $mennyiseg  = ($_SESSION["vasarolt_ossz"][$j]["mennyiseg"]) / 100;
                        $ossz_ar    = $_SESSION["vasarolt_ossz"][$j]["fizetni"];
                        $kezbesit   = $kezbesit;
                        $fizet_mod  = $kredit;
                        $teljes_osszeg = $_SESSION["teljes_osszeg"];
                        $created    = date("Y-m-d");
                        mysqli_stmt_execute($stmt);
                    }
                    echo '<h4>Megrendelését rögzítettük. <br>A szállítás dátumáról e-mail-ben értesítjük önt.</h4>';
                    $_SESSION['rendben'] = "Megrendelését rögzítettük.   A szállítás dátumáról e-mail-ben értesítjük önt.";
                    
                    unset($_SESSION["vasarolt_ossz"]);
                    unset($_SESSION["teljes_osszeg"]);
                    unset($_SESSION["kosar_tartalma"]);
                } else {
                    $_SESSION['fail'] = "Rendelését nem tudtuk felvenni: " . mysqli_error($conn);
                    echo "Hibás adatbevitel: " . $sql2 . "<br>" . mysqli_error($conn) . "<br>";
                }
            }
        } else {
            echo '<br><p>Valamely mezőt, vagy a kosarat üresen hagyta!</p>';
        }

        $x = mgbox();
        unset($_SESSION['rendben']);
        unset($_SESSION['fail']);
        unset($_SESSION['hiba']);

        if (mysqli_close($conn)) {
            echo '<p style="text-align:center;color:maroon;">A MySql kapcsolat bontva.</p>';
        } else {
            echo '<p style="text-align:center;color:maroon;">A kapcsolat a szerverel még él !!</p>';
        }
        ?>
        <p><a href="../kezdolap.php"><button class="btn-info fs-4"> &ensp; Vissza a Kezdőlapra &ensp; </button></a></p>
        <div class="row mt-3  fs-6">
            <div class="col-6 pt-4">
                <p class="text-danger">Termékáraink a 27%-os ÁFA-t is tartalmazzák</p>
            </div>
            <div class="col-6">
                <p><i>
                        Az ÁFA díjszabásról itt tájékozódhat: <br>
                        <a class="fs-6" href="https://net.jogtar.hu/jogszabaly?docid=a0700127.tv" target="blank">https://net.jogtar.hu/</a><br>
                        <a class="fs-6" href="https://szolgaltat.com/brutto-netto/27-os-afa/" target="blank">https://szolgaltat.com/brutto-netto/27-os-afa</a>
                    </i></p>
            </div>
        </div>
    </main>

</body>

</html>