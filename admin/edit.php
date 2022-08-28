<?php

session_start();

if (isset($_POST['id']) && isset($_POST['tipus']) && isset($_POST['ara'])) {
  if (filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS)) {
    $id       = $_POST['id'];
    $tipus    = $_POST['tipus'];
    $ara      = strip_tags($_POST['ara']);
    $ara      = floatval($ara);
    $ervenyes = strip_tags($_POST['ervenyes']);
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


    echo  $id . " | " . $tipus . " | " . floatval($ara) . " | " . $ervenyes .
      "| " . $tolo . " | " . $telj . " | " . $press . " | " . $bpr .
      "| " . $hossz . " | " . $dia . " | " . $suly . " | " . $alkalmaz;


    require_once('sql.php');
    $conn = nyit();
    $datum = date('Y-m-d');
    $sql1 = "UPDATE repcsimotor.arak SET ar = '$ara', tol = '$datum', ig ='$ervenyes' WHERE arak.t_id = $id;";

    $sql2 = "UPDATE repcsimotor.turbina SET 
            toloero           = '$tolo', 
            teljesit          = '$telj', 
            bpr               = '$bpr',
            nyomasarany       = '$press',
            hossz             = '$hossz',
            ventilator_atmero = '$dia', 
            suly              = '$suly',
            gep               = '$alkalmaz',
            extras            = '$reszlet',
            descript          = '$leir',
            modositva         = '$datum'
            WHERE turbina.t_id = $id;";

    if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql1)) {
      $_SESSION['rendben'] = "A turbina adatai sikeresen megváltoztak";
    } else {
      $_SESSION['fail'] = "Az adat módosítása nem történt meg: " . mysqli_error($conn);
    }
    mysqli_close($conn);
  } else {
    $_SESSION['hiba'] = "Elszúrtad a turbina árát!";
  }
}
header('location: dashboard.php');
