<?php

session_start();

if (isset($_POST['id1'])) {

    $id = $_POST['id1'];
  
    require_once('sql.php');
    $conn = nyit();
    $sql1 = "DELETE FROM repcsimotor.felhasznalo WHERE felhasznalo.felhasznalo_id = $id;";  
    
    if (mysqli_query($conn, $sql1)) {
        $_SESSION['rendben'] = "A felhasználó törlése megtörtént !!";         
      } 
      else {            
        $_SESSION['fail'] = "A FELHASZNÁLÓ NEM TÖRÖLHETŐ ! -  MÁR LÉTEZIK NEVÉRE KIÁLLÍTOTT SZÁMLA. | " . mysqli_error($conn);        
      }
      mysqli_close($conn);  
    
}
else{
    $_SESSION['hiba'] = "Nem töröltünk semmit";
}
header('location: felhasznalok.php');
?>
