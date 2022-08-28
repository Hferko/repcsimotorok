<?php

$conn;

function kapcsolat()
{
    require('./config.php');
    global $conn;
    mysqli_report(MYSQLI_REPORT_OFF);
    $connect = @mysqli_connect($servername, $username, $password, $dbname);

    if (!$connect) {
        die("Kapcsolódás sikertelen: " . mysqli_connect_error());
    }

    //echo '<h4 style="text-align:center;color:maroon;">Sikeres a kapcsolat !</h4>';
    $conn = $connect;
    return $connect;
}

// Ellenőrzi, hogy az adott táblában (paraméterként átadva) van-e adat (sor)
function verify($ident, $tabla)
{
    require('./config.php');
    global $conn;
    $db = $dbname;

    $ellenor = "SELECT `$ident` FROM `$db`.$tabla;";
    $eredmeny = mysqli_query($conn, $ellenor);
    $sor = mysqli_fetch_array($eredmeny);

    return $sor;
}

// -- Könyvtárbejárás rekurzívan --
function dirTombbe($folder)
{
    $multiTomb = [];
    $egeszMappa = scandir($folder);

    foreach ($egeszMappa as $kulcs => $fileNev) {
        if (!in_array($fileNev, array(".", ".."))) {
            if (is_dir($folder . DIRECTORY_SEPARATOR . $fileNev)) {
                $multiTomb[$fileNev] = dirTombbe($folder . DIRECTORY_SEPARATOR . $fileNev);
            } else {
                $multiTomb[] = $fileNev;
            }
        }
    }
    return $multiTomb;
}

// Legyen egy függvény, ahol a tábla tartalmát módosítom
// ez még NEM az Admin felületre készül, csak a táblák pontos létrehozásához
function tabla_javitas($attrib, $value, $feltetel)
{
    require('./config.php');
    global $conn;

    $db = $dbname;
    $javit = "UPDATE `$db`.`images` SET $attrib = $value
            WHERE `path` LIKE '$feltetel';";

    if (mysqli_query($conn, $javit)) {
        //echo '<p>'.$feltetel.' - rendben</p>';

    } else {
        echo "Hibás adatbevitel: " . $javit . "<br>" . mysqli_error($conn) . "<br>";
    }
}

// -- Kategóriák feltöltése
function category_insert()
{
    require('./config.php');
    global $conn;
    $db = $dbname;

    $row = verify('kat_id', 'category');

    if ($row != NULL) {
        echo "<h4>A kategória tábla már feltöltve, ezzel ne foglalkozz tovább.</h4>";
    } else {

        $sql1 = "INSERT INTO `$db`.`category` (`kat_nev1`, `kat_nev2`)
            VALUES 
            ('Kereskedelmi', 'Szélestestű Jet'),
            ('Kereskedelmi', 'Keskenytestű Jet'),
            ('Kereskedelmi', 'Üzleti repülőgép'),
            ('Kereskedelmi', 'Turbo-propeller'), 
            ('Kereskedelmi', 'Helikopter'),       
            ('Katonai', 'Vadászgép'),
            ('Katonai', 'Harci helikopter'),
            ('Katonai', 'Szállító repülőgép'),
            ('Ipari gázturbina', '-')
            ;";

        if (mysqli_query($conn, $sql1)) {

            echo '<h4>Új rekordok felvétele sikeresen megtörtént.</h4>';
        } else {
            echo "Hibás adatbevitel: " . $sql1 . "<br>" . mysqli_error($conn) . "<br>";
        }
    }
}

function turbina_insert()
{
    require('./config.php');
    global $conn;
    $db = $dbname;

    $row = verify('t_id', 'turbina');


    if ($row != NULL) {
        echo "<h4>A turbina tábla már feltöltve, használatra kész.</h4>";
    } else {
        $lines = file('adat.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $arrayOfLines = [];

        foreach ($lines as $line_num => $line) {

            $arrayOfLines[] = explode(';', $line);
        }

        $sql2 = "INSERT INTO `$db`.`turbina` (
                `nev`, 
                `kat`,                 
                `toloero`, 
                `teljesit`, 
                `bpr`, 
                `nyomasarany`,
                `hossz`,
                `ventilator_atmero`,
                `suly`,
                `gep`,
                `extras`,
                `descript`,
                `felv_datum`
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ;";

        if ($stmt = mysqli_prepare($conn, $sql2)) {

            mysqli_stmt_bind_param(
                $stmt,
                "sisssssssssss",
                $nev,
                $kat,
                $toloero,
                $teljesit,
                $bpr,
                $nyomasarany,
                $hossz,
                $ventilator_atmero,
                $suly,
                $gep,
                $extras,
                $descript,
                $felv_datum
            );

            for ($i = 0; $i < count($arrayOfLines); $i++) {
                $nev               = $arrayOfLines[$i][0];
                $kat               = $arrayOfLines[$i][1];
                $toloero           = $arrayOfLines[$i][2];
                $teljesit          = $arrayOfLines[$i][3];
                $bpr               = $arrayOfLines[$i][4];
                $nyomasarany       = $arrayOfLines[$i][5];
                $hossz             = $arrayOfLines[$i][6];
                $ventilator_atmero = $arrayOfLines[$i][7];
                $suly              = $arrayOfLines[$i][8];
                $gep               = $arrayOfLines[$i][9];
                $extras            = $arrayOfLines[$i][10];
                $descript          = $arrayOfLines[$i][11];
                $felv_datum        = date("Y-m-d");
                mysqli_stmt_execute($stmt);
            }
            echo '<h4>Hajtóművek felvétele sikeresen megtörtént.</h4>';
        } else {
            echo "Hibás adatbevitel: " . $sql2 . "<br>" . mysqli_error($conn) . "<br>";
        }
        mysqli_stmt_close($stmt);
    }
}

function images_insert()
{
    require('./config.php');
    global $conn;
    $db = $dbname;

    $row = verify('kep_id', 'images');

    if ($row != NULL) {
        echo "<h4>A képek táblája már feltöltve, használatra kész.</h4>";
    } else {
        $kepek = './assets/product';

        $osszKep = dirTombbe($kepek);

        $sql3 = "INSERT INTO `$db`.`images` (`path`, `alt`)
        VALUES (?, ?) ;";

        if ($stmt2 = mysqli_prepare($conn, $sql3)) {

            mysqli_stmt_bind_param($stmt2, "ss", $path, $alt);

            for ($i = 0; $i < count($osszKep); $i++) {
                $path =  $osszKep[$i];
                $alt  =  $osszKep[$i];
                mysqli_stmt_execute($stmt2);
            }
            echo '<h4>A képek betöltődtek az adatbázisba.</h4>';
        } else {
            echo "Hibás adatbevitel: " . $sql3 . "<br>" . mysqli_error($conn) . "<br>";
        }
        mysqli_stmt_close($stmt2);
    }

    // Kénytelen vagyok kézzel párosítani a képeket a turbinákkal    
    tabla_javitas('t_id', 1, 'CF6%');
    tabla_javitas('t_id', 2, 'GEnx%');
    tabla_javitas('t_id', 3, 'GE9X%');
    tabla_javitas('t_id', 4, 'GE90-110B%');
    tabla_javitas('t_id', 5, 'GP7000%');
    tabla_javitas('t_id', 6, 'PW4000%');
    tabla_javitas('t_id', 7, 'Soloviev%');
    tabla_javitas('t_id', 8, 'CF34%');
    tabla_javitas('t_id', 9, 'CFM56%');
    tabla_javitas('t_id', 10, 'GTF%');
    tabla_javitas('t_id', 11, 'JT8D%');
    tabla_javitas('t_id', 12, 'LEAP%');
    //tabla_javitas('t_id', 13, 'PW2000_%');
    //tabla_javitas('t_id', 14, 'PW6000_%');
    tabla_javitas('t_id', 15, 'V2500%');
    tabla_javitas('t_id', 16, 'PW300_%');
    tabla_javitas('t_id', 17, 'PW500_%');
    tabla_javitas('t_id', 18, 'PW600_%');
    tabla_javitas('t_id', 19, 'PT6A%');
    tabla_javitas('t_id', 20, 'PW150%');
    tabla_javitas('t_id', 21, 'PW200_%');
    tabla_javitas('t_id', 22, 'PW210%');
    tabla_javitas('t_id', 23, 'PT6T%');
    tabla_javitas('t_id', 24, 'Klimov%');
    tabla_javitas('t_id', 25, 'EJ200_%');
    tabla_javitas('t_id', 26, 'F110%');
    tabla_javitas('t_id', 27, 'F414%');
    tabla_javitas('t_id', 28, 'Larzac%');
    tabla_javitas('t_id', 29, 'Saturn%');
    tabla_javitas('t_id', 30, 'RB199%');
    tabla_javitas('t_id', 31, 'MTR390%');
    tabla_javitas('t_id', 32, 'T64_%');
    tabla_javitas('t_id', 33, 'T408_%');
    tabla_javitas('t_id', 34, 'TP400%');
    tabla_javitas('t_id', 35, 'LM2500%');
    tabla_javitas('t_id', 36, 'LM6000%');
    tabla_javitas('t_id', 37, 'SGT-800%');
    tabla_javitas('t_id', 14, 'PW6000_%');
    tabla_javitas('t_id', 13, 'PW2000_%');

    tabla_javitas('alap', 1, '%_1.webp');
}

function admin_regisztral()
{
    require('./config.php');
    global $conn;
    $db = $dbname;

    $row = verify('felhasznalo_id', 'felhasznalo');

    if ($row != NULL) {
        echo "<p>Admin OK.</p>";
    } else {

        $sql4 = "INSERT INTO `$db`.`felhasznalo` (`neve`, `jelszo`, `email`, `ip_cim`, `reg_datum`, `status`)
        VALUES (?, ?, ?, ?, ?, ?) ;";

        if ($dictum = mysqli_prepare($conn, $sql4)) {

            mysqli_stmt_bind_param($dictum, "ssssss", $neve, $jelszo, $email, $ip_cim, $reg_datum, $status);

            $neve      = "admin";
            $jelszo    = password_hash("jelszo", PASSWORD_BCRYPT);
            $email     = "geza@freemail.hu";
            $ip_cim    = $_SERVER['REMOTE_ADDR'];
            $reg_datum = date("Y-m-d");
            $status    = "admin";
            mysqli_stmt_execute($dictum);

            $neve      = "Oriza Triznyák";
            $jelszo    = password_hash("1234", PASSWORD_BCRYPT);
            $email     = "oriza@freemail.hu";
            $ip_cim    = $_SERVER['REMOTE_ADDR'];
            $reg_datum = date("Y-m-d");
            $status    = "vásárló";
            mysqli_stmt_execute($dictum);


            echo "Admin és egy felhasználó felvéve";
        } else {
            echo "ERROR: Gáz van az admin-nal: $sql4. " . mysqli_error($conn);
        }
        mysqli_stmt_close($dictum);
    }
}

function ar_insert()
{
    require('./config.php');
    global $conn;
    $db = $dbname;

    $row = verify('ar_id', 'arak');

    if ($row != NULL) {
        echo "<h4>A képek táblája már feltöltve, használatra kész.</h4>";
    } else {
    $lekerdez = "SELECT `turbina`.`t_id`
                  FROM `$db`.`turbina`;";

    $turbinak = mysqli_query($conn, $lekerdez);

    $sql = "INSERT INTO `$db`.`arak` (`t_id`, `ar`, `tol`, `ig`)
    VALUES (?, ?, ?, ?) ;";

    if ($stmt = mysqli_prepare($conn, $sql)) {

        mysqli_stmt_bind_param($stmt, "idss", $t_id, $ar, $tol, $ig);

        while ($sor = mysqli_fetch_array($turbinak)) {
            $id = $sor["t_id"];
            if ($id < 8) {
                $t_id = $sor["t_id"];
                $ar   = (1898945 * $id * pi());
                $tol  = date("Y-m-d");
                $ig   = '2023-12-31';
            } elseif (7 < $id and $id < 16) {
                $t_id = $sor["t_id"];
                $ar   = (118645 * $id * pi());
                $tol  = date("Y-m-d");
                $ig   = '2023-12-31';
            } elseif (15 < $id and $id < 24) {
                $t_id = $sor["t_id"];
                $ar   = (919864 * $id * pi());
                $tol  = date("Y-m-d");
                $ig   = '2023-12-31';
            } elseif (23 < $id and $id < 31) {
                $t_id = $sor["t_id"];
                $ar   = (898945 * $id * pi());
                $tol  = date("Y-m-d");
                $ig   = '2023-12-31';
            }
            elseif (30 < $id and $id < 35) {
                $t_id = $sor["t_id"];
                $ar   = (198945 * $id * pi());
                $tol  = date("Y-m-d");
                $ig   = '2023-12-31';
            }
            elseif (34 < $id) {
                $t_id = $sor["t_id"];
                $ar   = (9894 * $id * pi());
                $tol  = date("Y-m-d");
                $ig   = '2023-12-31';
            }
            mysqli_stmt_execute($stmt);
        }
    } else {
        echo "Hibás adatbevitel: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
    }
    mysqli_stmt_close($stmt);
    }
}
