<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
  <link rel="stylesheet" href="../assets/css/style.css">
  <title>Képek feltöltése</title>
</head>

<body>
  <main>
    <div style="text-align:center">
      <h3>Képek feltöltése az felvett turbinához</h3>
    </div>

    <div class="card">
      <form method="POST" enctype="multipart/form-data">
        <label for="kep">Kérem töltsön fel egy képet</label>
        <input type="file" id="kep" name="kep" value=""><br><br>
        <label for="cim">Itt megadhatja a kép címét:</label>
        <input type="text" id="cim" name="cim" value=""><br><br>
        <input type="submit" value="KÉP FELTÖLTÉSE">
        <button onclick="history.go(-1)"><span> MÉGSEM </span></button>
      </form>

      <?php

      require('sql.php');
      require('sessions.php');

      $x = mgbox();

      unset($_SESSION['rendben']);
      unset($_SESSION['fail']);
      unset($_SESSION['hiba']);

      if (isset($_SESSION['turbina_id'])) {
        $turbina_id = $_SESSION['turbina_id'];
        echo '<br>Turbina ID = ' . $turbina_id;
      } else {
        echo '<br>Nem kapta még meg az ID-t';
      }



      if (isset($_POST['cim']) && isset($_FILES['kep']) && $_FILES['kep']['error'] === 0) {

        $target_dir    = "../assets/product/";
        $target        = $target_dir . basename($_FILES['kep']['name']);
        $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
        $kep_cim       = $_POST['cim'] . "." . $imageFileType;
        $target_file   = $target_dir . $_POST['cim'] . "." . $imageFileType;


        $feltoltesOK = 0;

        if (file_exists($target_file)) {
          echo '<br>Ezzel a névvel egy file már létezik a szerveren.<br>';
          $feltoltesOK = 0;
          return;
        }

        // Próbálom szűrni a file-okat
        $check = getimagesize($_FILES["kep"]["tmp_name"]);
        if ($check !== false) {
          echo "<br>Ez egy valódi kép - " . $check["mime"] . ".";
          $feltoltesOK = 1;
        } else {
          echo "Ez a file nem egy kép. ";
          $feltoltesOK = 0;
          return;
        }

        // Próbálom szűrni a file-okat
        if (
          $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" && $imageFileType != "webp"
        ) {
          echo "<br>Lehetőleg, csak .jpg, .jpeg, .png, .gif, vagy .webp  file-okat töltsön fel, egyebet nem fogad a szerver.";
          $feltoltesOK = 0;
        } else {

          if ($feltoltesOK > 0 && copy($_FILES['kep']['tmp_name'], '../assets/product/' . $_POST['cim'] . "." . $imageFileType)) {

            $conn = nyit();

            // Megkeresem a képek adattéblából azt, ahol csak a 't_id' van megadva és nincs hozzá még kép
            $utolsoID = "SELECT kep_id FROM `images` WHERE t_id = $turbina_id AND `path` IS NULL;";
            $eredmeny = mysqli_query($conn, $utolsoID);
            $utolso = mysqli_fetch_array($eredmeny);

            // Ha nincs kép az új id-hez, akkor UPDATE a tábla, beleteszek egy képet
            if (mysqli_num_rows($eredmeny) > 0) {

              $sql1 = "UPDATE repcsimotor.images SET `path` = '$kep_cim', alt = '$kep_cim' WHERE images.t_id = $turbina_id  AND images.alap = 1;";

              if (mysqli_query($conn, $sql1)) {
                echo "<br>A " . $kep_cim . "Kép feltöltve az adatbázisba.";
              } else {
                echo "Hiba történt az adatbázisba felvétel közben: " . mysqli_error($conn);
              }
            }

            // Ha már van az ID-hez kép, akkor a következő képpel és t_id-vel egy teljesen új rekordot veszek fel
            else {
              $sql2 = "INSERT INTO repcsimotor.images (`t_id`, `path`, `alt`)
                    VALUES ($turbina_id, '$kep_cim', '$kep_cim') ;";

              if (mysqli_query($conn, $sql2)) {
                echo "<br>A " . $kep_cim . "Kép feltöltve az adatbázisba.";
              } else {
                echo "Hiba történt az adatbázisba felvétel közben: " . $sql2 . "<br>" . mysqli_error($conn);
              }
            }
          }
        }
        mysqli_close($conn);

        // Értesítem a felhasználót, hogy sikeres volt-e a feltöltés
        if ($feltoltesOK == 0) {
          echo "<h4> Sajnos ez a  file nem került feltöltésre.</h4>";
        } else {
          echo '<p>Ez a file: ' . htmlspecialchars(basename($_FILES['kep']['name'])) . ' ; ' . ' (' . $_FILES["kep"]["size"] . ' byte) feltöltve a szerverre.</p>';
          echo '<h4>Ide: repcsimotorok\assets\product\<b>' . $_POST['cim'] . "." . $imageFileType . '</b> néven.</h4>';
          echo '<br><img src="' . $target_file . '" height="150">';
          echo '<p><i> Jöhet a következő kép... </i> </p>';
        }
        array_splice($_FILES, 0);
        array_splice($_POST, 0);
        $_FILES = [];
        $_POST  = [];
      } else {
        echo "<h4> Nem választott ki egy képet sem.</h4>";
      }
      // A két tömböt ki kell ürítenem, különben frisítéskor újra bedolgozza az adatokat
      $_FILES = [];
      $_POST  = [];
      array_splice($_FILES, 0);
      array_splice($_POST, 0);
      ?>

      <a class="close" onclick="history.go(-1)">
        <button><span><a href="dashboard.php"> VISSZA AZ ADMIN OLDALÁRA </a></span></button>
      </a>

    </div>

  </main>
</body>

</html>