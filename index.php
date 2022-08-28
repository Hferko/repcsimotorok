<?php
require_once('db/dbcreat.php');
require_once('db/dbfill.php');
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Adatbázis előkészítése</title>
</head>

<body>
    <main>
        <h2>Adatbázis létrehozása</h2>
        <div class="card">
            <p>Kapcsolódás a szerverhez</p>
            <?php
            $conn = nyit();
            echo '<hr>';
            createdb();
            echo '<hr>';
            category_table();
            echo '<hr>';
            turbina_table();
            echo '<hr>';
            images_table();
            echo '<hr>';
            arak_table();
            echo '<hr>';
            felhasznalo_table();
            
            echo '<hr>';
            szamla_table();
            ?>
        </div>
        <h2>Adatbázis feltöltése</h2>
        <div class="card">
            <?php
            category_insert();
            echo '<hr>';
            turbina_insert();
            echo '<hr>';
            images_insert();
            echo '<hr>';
            admin_regisztral();
            echo '<hr>';
            ar_insert();            
            ?>
        </div>


        <div class="card">
            <?php if (mysqli_close($conn)) {
                echo '<h4 style="text-align:center;color:maroon;">A MySql kapcsolat bontva.</h4>';
            } else {
                echo '<h4 style="text-align:center;color:maroon;">A kapcsolat a szerverel még él !!</h4>';
            }
            ?>
        </div>

    </main>
</body>
</html>
<?php
if($flag == true){
   header('location: kezdolap.php'); 
}
?>