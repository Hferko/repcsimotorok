<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <title>Regisztráció</title>
</head>

<body style="background-image:url(../assets/img/mtu.jpg);background-size: cover;">
    <main>
        <?php
        require('sql.php');
        $conn = nyit();

        if (isset($_REQUEST['nev']) && isset($_POST['password1'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                // A form-ról beolvasott adatok (próbáltam a nem odavaló karaktereket kiküszöbölni):

                $nev = filter_var($_POST['nev'], FILTER_SANITIZE_SPECIAL_CHARS);
                $nev = strip_tags($_POST['nev']);
                $nev = mysqli_real_escape_string($conn, $nev);

                $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
                $email = strip_tags($_POST['email']);
                $email = mysqli_real_escape_string($conn, $email);

                $password1 = filter_var($_POST['password1'], FILTER_SANITIZE_SPECIAL_CHARS);
                $password1 = strip_tags($_POST['password1']);
                $password1 = mysqli_real_escape_string($conn, $password1);

                $password2 = filter_var($_POST['password2'], FILTER_SANITIZE_SPECIAL_CHARS);
                $password2 = strip_tags($_POST['password2']);
                $password2 = mysqli_real_escape_string($conn, $password2);

                // ellenőrzi, hogy a form-on minden mező ki van-e töltve

                if (empty($nev)) {
                    echo "Név kitöltése szükséges";
                }
                if (empty($email)) {
                    echo "Adja meg az Email címét";
                }
                if (empty($password1)) {
                    echo "Jelszó nélkül nem tud belépni";
                }
                if ($password1 != $password2) {
                    echo "A két beírt jelszó nem egyezik meg!";
                }

                // itt ellenőrzöm, hogy a beírt név/email már létezik-e ha nem felveszi az adatbázisba az újat, új id-vel
                $lekerdez = "SELECT felhasznalo_id FROM `repcsimotor`.`felhasznalo` WHERE neve = '$nev';";
                $eredmeny = mysqli_query($conn, $lekerdez);
                $sor = mysqli_fetch_array($eredmeny);

                $lekerdez2 = "SELECT email FROM `repcsimotor`.`felhasznalo` WHERE email = '$email';";
                $eredmeny2 = mysqli_query($conn, $lekerdez2);
                $sor2 = mysqli_fetch_array($eredmeny2);

                if (mysqli_num_rows($eredmeny) > 0) {
                    $nev_id = $sor['felhasznalo_id'];
                    echo "<div class='form'><h3>Ezzel a névvel már van regisztrált felhasználó: " . $nev . "</h3>Ha Ön az kattintson ide a bejelentkezéshez: &nbsp;<b> <a href='login.php'>BELÉPÉS</a></b></div><hr>";
                    echo '<div class="form"><p style="text-align:center;">Ha nem Ön regisztrált ezzel a névvel, kérjük regisztráljon más névvel: <br><b> <a href="regisztral.php">REGISZTRÁCIÓ</a> </b></p></div><hr>';
                } elseif (mysqli_num_rows($eredmeny2) > 0) {
                    echo "<div class='form'><h4>Ezzel az email címmel már van regisztrált felhasználó: " . $email . "</h4>Ha ez az Ön e-mail címe kattintson ide a bejelentkezéshez: &nbsp; <a href='login.php'>BELÉPÉS</a></div><hr>";
                    echo '<div class="form"><p style="text-align:center;">Ha nem Ön regisztrált ezzel a címmel, kérjük regisztráljon másikkal: <br><b> <a href="regisztral.php">REGISZTRÁCIÓ</a> </b></p></div>';
                }

                //--------------------------------
                else {
                    $sql = "INSERT INTO `repcsimotor`.`felhasznalo` (`neve`, `jelszo`, `email`, `ip_cim`, `reg_datum`, `status`)
        VALUES (?, ?, ?, ?, ?, ?) ;";

                    if ($dictum = mysqli_prepare($conn, $sql)) {

                        mysqli_stmt_bind_param($dictum, "ssssss", $neve, $jelszo, $email, $ip_cim, $reg_datum, $status);

                        $neve      = "$nev";
                        $jelszo    = password_hash("jelszo", PASSWORD_BCRYPT);
                        $email     = "$email";
                        $ip_cim    = $_SERVER['REMOTE_ADDR'];
                        $reg_datum = date("Y-m-d");
                        $status    = 'vásárló';
                        mysqli_stmt_execute($dictum);
                        echo "<div class='form'><h3>Az Ön regisztrációja sikeres.</h3><br/>Kattintson ide a bejelentkezéshez <h3><a href='login.php'>BELÉPÉS</a></h3></div>";
                    } else {
                        echo "ERROR: Gáz van az admin-nal: $sql. " . mysqli_error($conn);
                    }
                    mysqli_stmt_close($dictum);
                }
            } else {
                print "Nem megfelelő email cím";
            }
        } else {
        ?>
            <div class="card">
                <div class="form">
                    <h2>Regisztráció</h2>
                    <form name="registration" action="" method="POST">
                        <div class="input-container">
                            <i class="fa fa-user icon"></i>
                            <input class="input-field" type="text" name="nev" placeholder="Felhasználónév" required />
                        </div>
                        <div class="input-container">
                            <i class="fa fa-envelope icon"></i>
                            <input class="input-field" type="email" name="email" placeholder="Email" required />
                        </div>
                        <div class="input-container">
                            <i class="fa fa-key icon"></i>
                            <input class="input-field" type="password" name="password1" placeholder="Jelszó" required />
                        </div>
                        <div class="input-container">
                            <i class="fa fa-key icon"></i>
                            <input class="input-field" type="password" name="password2" placeholder="Jelszó ismét" required />
                        </div>
                        <input type="submit" name="submit" value="Regisztrálok" />
                    </form>

                </div>
            <?php } ?>
            </div>
    </main>
</body>

</html>