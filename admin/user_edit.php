<?php

session_start();

if (isset($_POST['id']) && isset($_POST['neve']) && isset($_POST['email'])) {
  if (filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS)) {
    $id      = $_POST['id'];
    $neve    = strip_tags($_POST['neve']);
    $email   = filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL);    
    $ip      = strip_tags($_POST['ip']);
    $reg     = strip_tags($_POST['reg']);
    $status  = strip_tags($_POST['status']);
    $vez_nev = strip_tags($_POST['vez_nev']);
    $ker_nev = strip_tags($_POST['ker_nev']);
    $telefon = strip_tags($_POST['telefon']);
    $varos   = strip_tags($_POST['varos']);
    $varos   = strip_tags($_POST['varos']);
    $cim     = strip_tags($_POST['cim']);

    echo $status;

    require_once('sql.php');
    $conn = nyit();
    $datum = date('Y-m-d');    

    $sql2 = "UPDATE repcsimotor.felhasznalo SET 
            `neve`      = '$neve', 
            `email`     = '$email', 
            `ip_cim`    = '$ip',
            `reg_datum` = '$reg',
            `status`    = '$status',
            `vez_nev`   = '$vez_nev',
            `ker_nev`   = '$ker_nev', 
            `telefon`   = '$telefon',
            `varos`     = '$varos',
            `cim`       = '$cim'       
            WHERE felhasznalo.felhasznalo_id = $id;";

    if (mysqli_query($conn, $sql2)) {
      $_SESSION['rendben'] = "A felhasználó adatai sikeresen megváltoztak";
    } else {
      $_SESSION['fail'] = "Az adat módosítása nem történt meg: " . mysqli_error($conn);
    }
    mysqli_close($conn);
  } else {
    $_SESSION['hiba'] = "Elszúrtad valamely adatot";
  }
}
header('location: felhasznalok.php');
