<?php

session_start();

if (isset($_POST['id1'])) {

    $id = $_POST['id1'];
  
    require_once('sql.php');
    $conn = nyit();
    $sql1 = "DELETE FROM repcsimotor.arak WHERE t_id = $id;";
    $sql2 = "DELETE FROM repcsimotor.images WHERE t_id = $id;";
    $sql3 = "DELETE FROM repcsimotor.turbina WHERE t_id = $id;";
    
    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
        $_SESSION['rendben'] = "A ". $id." azonosítójú turbina törlése teljes egészében megtörtént !!";         
      } 
      else {            
        $_SESSION['fail'] = "A turbina nem került törlésre: " . mysqli_error($conn);        
      }
      mysqli_close($conn);  
    
}
else{
    $_SESSION['hiba'] = "Nem töröltünk semmit";
}
header('location: dashboard.php');
?>
