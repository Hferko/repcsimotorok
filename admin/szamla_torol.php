<?php

session_start();

if (isset($_POST['tetel1']) && isset($_POST['csokkent']) && isset($_POST['szamlaszam1'])) {

    $tetel         = $_POST['tetel1'];
    $teljes_osszeg = $_POST['csokkent'];
    $szamlaszam    = $_POST['szamlaszam1'];
    echo $teljes_osszeg;
  
    require_once('sql.php');
    $conn = nyit();
    $sql1 = "DELETE FROM repcsimotor.szamla WHERE szamla.tetel = $tetel;";

    $sql2 = "UPDATE repcsimotor.szamla SET             
            `teljes_osszeg`    = $teljes_osszeg
            WHERE szamla.szamlaszam = $szamlaszam;";
    
    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
        $_SESSION['rendben'] = "A ". $tetel ." sz. tétel törlése megtörtént !!";         
      } 
      else {            
        $_SESSION['fail'] = "A tétel nem került törlésre: " . mysqli_error($conn);        
      }
      mysqli_close($conn);  
    
}
else{
    $_SESSION['hiba'] = "Nem töröltünk semmit";
}
//header('location: szamla_admin.php');
?>
