<?php

if (!isset($_SESSION['nev'])) {
    header("Location: login.php");
    exit();
} 

else {
    print('<p style="color: navy;">Bejelentkezve, mint: ' . $_SESSION['nev'].'</p>');    
}

?>