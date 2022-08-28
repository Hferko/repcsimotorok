 <?php

    $conn;

    function nyit()
    {
        require('../config.php');
        global $conn;
        mysqli_report(MYSQLI_REPORT_OFF);
        $connect = @mysqli_connect($servername, $username, $password, $dbname, $port);

        if (!$connect) {
            die("Kapcsolódás sikertelen: " . mysqli_connect_error());
        }
        //echo '<h4 style="text-align:center;color:maroon;">Sikeres a kapcsolat !</h4>';
        $conn = $connect;
        return $connect;
    }


    function sorokSzama()
    {
        global $conn;
        require('../config.php');
        $db = $dbname;

        $sql = "SELECT t_id FROM `$db`.turbina;";

        if (!mysqli_query($conn, $sql)) {
            print("Az adattábla nem nyitható meg<br>");
            return "";
        } else {
            $result = mysqli_query($conn, $sql);
            $sorok = mysqli_num_rows($result);

            echo '<p class="fs-5">Ennyi motor található jelenleg a turbinák adatbázisában: ' . $sorok . '</p>';
            return $sorok;
        }
    }

    function userSorok()
    {
        global $conn;
        require('../config.php');
        $db = $dbname;

        $sql = "SELECT `felhasznalo_id` FROM `$db`.`felhasznalo`;";

        if (!mysqli_query($conn, $sql)) {
            print("Az adattábla nem nyitható meg<br>");
            return "";
        } else {
            $result = mysqli_query($conn, $sql);
            $sorok = mysqli_num_rows($result);

            echo '<p class="fs-5">Ennyi felhasználó regisztrált eddig a web-shopban: ' . $sorok . ' fő</p>';
            return $sorok;
        }
    }

    function szamlaSorok()
    {
        global $conn;
        require('../config.php');
        $db = $dbname;

        $sql1 = "SELECT COUNT(*) AS 'ossz_szamla' FROM (SELECT szamlaszam FROM `$db`.`szamla` GROUP BY szamlaszam) AS alap;";
        $sql = "SELECT `tetel` FROM `$db`.`szamla`;";

        if (!mysqli_query($conn, $sql) && !mysqli_query($conn, $sql1)) {
            print("Az adattábla nem nyitható meg<br>");
            return "";
        } else {
            $eredmeny = mysqli_query($conn, $sql1);
            $szamlak  = mysqli_fetch_array($eredmeny);
            $szamlak_szama = $szamlak["ossz_szamla"];
            $result = mysqli_query($conn, $sql);
            $sorok = mysqli_num_rows($result);

            echo 'A web-shopban ennyi számla került kiállításra: ' . $szamlak_szama;
            echo '<p>A számlák <b class="fs-5">' . $sorok . '</b> tételt tartalmaznak összesen.</p>';
            return $sorok;
        }
    }

    function tablaTartalom($kezd, $lim)
    {
        global $conn;
        require('../config.php');
        $db = $dbname;

        $sql2 = "SELECT `turbina`.t_id, turbina.nev, category.kat_nev1, category.kat_nev2, arak.ar, arak.ig, images.path, images.alt
        FROM (((`$db`.`turbina`         
        INNER JOIN category ON turbina.kat=category.kat_id)        
        INNER JOIN images ON turbina.t_id=images.t_id)
        INNER JOIN arak ON turbina.t_id=arak.t_id)
        WHERE images.alap =1 ORDER BY t_id ASC LIMIT $kezd, $lim;";

        $eredmeny = mysqli_query($conn, $sql2);
        return $eredmeny;
    }
    

    function userTabla($kezd, $lim)
    {
        global $conn;
        require('../config.php');
        $db = $dbname;

        $sql2 = "SELECT 
                `felhasznalo_id`, 
                `neve`, 
                `email`, 
                `vez_nev`,
                `ker_nev`,
                `telefon`,
                `ir_szam`,
                `varos`,
                `cim`,
                `ip_cim`, 
                `reg_datum`, 
                `latest`, 
                `status`
        FROM `$db`.`felhasznalo`        
        ORDER BY felhasznalo_id ASC LIMIT $kezd, $lim;";

        $eredmeny = mysqli_query($conn, $sql2);
        return $eredmeny;
    }

    function szamlaTabla($kezd, $lim)
    {
        global $conn;
        require('../config.php');
        $db = $dbname;

        $sql2 = "SELECT  
                    `tetel`, 
                    `szamlaszam`, 
                    `email`, 
                    `comment`, 
                    `t_id`, 
                    `tipus`, 
                    `egyseg_ar`, 
                    `mennyiseg`,
                    `ossz_ar`,
                    `kezbesit`,
                    `fizet_mod`,
                    `teljes_osszeg`,
                    `created` 
            FROM `$db`.`szamla`        
        ORDER BY `tetel` ASC LIMIT $kezd, $lim;";

        $eredmeny = mysqli_query($conn, $sql2);
        return $eredmeny;
    }
    ?>

