<?php
session_start();

if (isset($_POST['tipus3']) && isset($_POST['ara3']) && isset($_POST['kategoria3']) && isset($_POST['ervenyes3'])) {

    if (filter_var($_POST['tipus3'], FILTER_SANITIZE_SPECIAL_CHARS)) {
        $tipus = strip_tags($_POST['tipus3']);
        $kategoria = strip_tags($_POST['kategoria3']);
        $ara      = strip_tags($_POST['ara3']);
        $ara      = floatval($ara);
        $ervenyes = strip_tags($_POST['ervenyes3']);
        $tolo     = strip_tags($_POST['tolo']);
        $telj     = strip_tags($_POST['telj']);
        $press    = strip_tags($_POST['press']);
        $bpr      = strip_tags($_POST['bpr']);
        $hossz    = strip_tags($_POST['hossz']);
        $dia      = strip_tags($_POST['dia']);
        $suly     = strip_tags($_POST['suly']);
        $alkalmaz = strip_tags($_POST['alkalmaz']);
        $reszlet  = strip_tags($_POST['reszlet']);
        $leir     = strip_tags($_POST['leir']);

        echo  $tipus . " | " . floatval($ara) . " | " . $ervenyes .
            "| " . $tolo . " | " . $telj . " | " . $press . " | " . $bpr .
            "| " . $hossz . " | " . $dia . " | " . $suly . " | " . $alkalmaz . " | " . $reszlet . " | " .  $leir;


        require_once('sql.php');
        $conn = nyit();
        $datum = date('Y-m-d');


        $sql1 = "INSERT INTO `repcsimotor`.`turbina` (
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

        if ($stmt1 = mysqli_prepare($conn, $sql1)) {

            mysqli_stmt_bind_param(
                $stmt1,
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

            $nev               = strip_tags($_POST['tipus3']); 
            $kat               = (int)strip_tags($_POST['kategoria3']); 
            $toloero           = strip_tags($_POST['tolo']); 
            $teljesit          = strip_tags($_POST['telj']);
            $bpr               = strip_tags($_POST['bpr']);
            $nyomasarany       = strip_tags($_POST['press']);
            $hossz             = strip_tags($_POST['hossz']);
            $ventilator_atmero = strip_tags($_POST['dia']);
            $suly              = strip_tags($_POST['suly']);
            $gep               = strip_tags($_POST['alkalmaz']); 
            $extras            = strip_tags($_POST['reszlet']); 
            $descript          = strip_tags($_POST['leir']); 
            $felv_datum        = $datum; 
            mysqli_stmt_execute($stmt1);

            $utolso_id = mysqli_insert_id($conn);
            $_SESSION['turbina_id'] = $utolso_id;

            echo "Az utolj??ra beillesztett azonos??t??: " . $utolso_id . "<hr>";

            //$_SESSION['rendben'] = "A hajt??m?? felv??tele sikeresen megt??rt??nt.";
        } else {

            $_SESSION['fail'] = "Hib??s adatbevitel: " . $sql1 . " - " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt1);

        // Besz??r??s az ??rak t??bl??ba -------------------------
        $sql2 = "INSERT INTO `repcsimotor`.`arak` (`t_id`, `ar`, `tol`, `ig`)
                    VALUES (?, ?, ?, ?) ;";

        if ($stmt2 = mysqli_prepare($conn, $sql2)) {

            mysqli_stmt_bind_param($stmt2, "idss", $t_id, $ar, $tol, $ig);
            $t_id = $utolso_id;
            $ar   = $ara;
            $tol  = date("Y-m-d");
            $ig   = $ervenyes;
            mysqli_stmt_execute($stmt2);
        } else {
            $_SESSION['fail'] = "Hib??s adatbevitel: " . $sql2 . " - " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt2);

        //$_SESSION['rendben'] = "A hajt??m?? felv??tele sikeresen megt??rt??nt.";
        echo "Az utolj??ra beillesztett turbina azonos??t??: " . $utolso_id . "<hr>";


        // Besz??r??s a k??pek t??bl??ba -------------------------
        $sql3 = "INSERT INTO `repcsimotor`.`images` (t_id, alap)
                VALUES (?, ?);";

        if ($stmt3 = mysqli_prepare($conn, $sql3)) {

            mysqli_stmt_bind_param($stmt3, "ii", $t_id, $alap);
            $t_id = $utolso_id;
            $alap = 1;
            mysqli_stmt_execute($stmt3);
            $_SESSION['rendben'] = "Az ??j hajt??m?? felv??tele sikeresen megt??rt??nt.";

        } else {
            $_SESSION['fail'] = "Hib??s adatbevitel: " . $sql3 . " - " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt3);

    } else {
        $_SESSION['hiba'] = "Elsz??rtad a turbina valamely param??ter??t!";
    }
    mysqli_close($conn);
}
header('location: kepfeltolt.php');
