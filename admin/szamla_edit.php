<?php

session_start();

if (isset($_POST['tetel']) && isset($_POST['szamlaszam']) && isset($_POST['email'])) {
    if (filter_var($_POST['tetel'], FILTER_SANITIZE_SPECIAL_CHARS)) {
        $tetel          = $_POST['tetel'];
        $szamlaszam     = $_POST['szamlaszam'];
        $email          = $_POST['email'];
        $tipus          = $_POST['tipus'];
        $egyseg_ar      = $_POST['egyseg_ar'];
        $mennyiseg      = strip_tags($_POST['mennyiseg']);
        $ossz_ar1       = strip_tags($_POST['ossz_ar']);
        $ossz_ar        = floatval($egyseg_ar) * floatval($mennyiseg);
        $kezbesit       = strip_tags($_POST['kezbesit']);
        $fizet_mod      = strip_tags($_POST['fizet_mod']);
        $teljes_osszeg1 = strip_tags($_POST['teljes_osszeg']);
        $teljes_osszeg  = floatval($teljes_osszeg1) - floatval($ossz_ar1) + $ossz_ar;
        $comment        = strip_tags($_POST['comment']);

        echo 'mennyiseg: '. $mennyiseg. '<br>';
        echo 'egysegar: ' . $egyseg_ar . '<br>';
        echo 'ossz_ar: ' . $ossz_ar . '<br>';
        echo 'teljes_osszeg:  ' . $teljes_osszeg . '<br><br> ';

        echo 'teljes_osszeg11: ' .  floatval($teljes_osszeg1) . '<br>';
        echo '$ossz_ar1: ' . floatval($ossz_ar1) . '<br>';

        echo 'számlaszám: ' . $szamlaszam . '<br>';

       
        require_once('sql.php');
        $conn = nyit();
        $datum = date('Y-m-d');

        $sql2 = "UPDATE repcsimotor.szamla SET 
            `comment` = '$comment',
            `mennyiseg`    = '$mennyiseg',
            `ossz_ar`   = '$ossz_ar',
            `kezbesit`   = '$kezbesit', 
            `fizet_mod`   = '$fizet_mod',
            `teljes_osszeg`     = '$teljes_osszeg'
            WHERE szamla.tetel = $tetel;";

        $sql3 = "UPDATE repcsimotor.szamla SET             
            `teljes_osszeg`    = $teljes_osszeg
            WHERE szamla.szamlaszam = $szamlaszam;";

        if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
            $_SESSION['rendben'] = "A számla adatai sikeresen megváltoztak";
        } else {
            $_SESSION['fail'] = "Az adatok módosítása nem történt meg: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    } else {
        $_SESSION['hiba'] = "Elszúrtad valamely adatot";
    }
}
header('location: szamla_admin.php');
