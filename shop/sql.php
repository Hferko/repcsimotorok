 <?php

    $conn;

    function nyit()
    {
        require('./config.php');
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
   

    function sorokSzama(){
        global $conn;     
        require('./config.php');
        $db = $dbname;

        $sql = "SELECT t_id FROM `$db`.turbina;";   

        if(!mysqli_query($conn, $sql)){
            print("Az adattábla nem nyitható meg<br>");
            return "";
        }
        else{
            $result = mysqli_query($conn, $sql);
            $sorok = mysqli_num_rows($result);

            //echo '<p class="fs-6">Ennyi motor található jelenleg a turbinák adatbázisában: ' . $sorok . '</p>';
            return $sorok;
        }        
    }

    function sorokSzama_keredkedelmi()
    {
        global $conn;
        require('./config.php');
        $db = $dbname;

        $sql = "SELECT t_id FROM `$db`.turbina WHERE kat < 6;";

        if (!mysqli_query($conn, $sql)) {
            print("Az adattábla nem nyitható meg<br>");
            return "";
        } else {
            $result = mysqli_query($conn, $sql);
            $sorok = mysqli_num_rows($result);
            return $sorok;
        }
    }

    function sorokSzama_katonai()
    {
        global $conn;
        require('./config.php');
        $db = $dbname;

        $sql = "SELECT t_id FROM `$db`.turbina WHERE kat BETWEEN 6 AND 8;";

        if (!mysqli_query($conn, $sql)) {
            print("Az adattábla nem nyitható meg<br>");
            return "";
        } else {
            $result = mysqli_query($conn, $sql);
            $sorok = mysqli_num_rows($result);
            return $sorok;
        }
    }

    function sorokSzama_ipari()
    {
        global $conn;
        require('./config.php');
        $db = $dbname;

        $sql = "SELECT t_id FROM `$db`.turbina WHERE kat > 8;";

        if (!mysqli_query($conn, $sql)) {
            print("Az adattábla nem nyitható meg<br>");
            return "";
        } else {
            $result = mysqli_query($conn, $sql);
            $sorok = mysqli_num_rows($result);
            return $sorok;
        }
    }  


    function tablaTartalom_mind($kezd, $lim){        
        global $conn;
        require('./config.php');
        $db = $dbname;
        
        $sql2 = "SELECT `turbina`.t_id, turbina.nev, turbina.gep, category.kat_nev1, category.kat_nev2, arak.ar, images.path, images.alt
        FROM (((`$db`.`turbina`         
        INNER JOIN category ON turbina.kat=category.kat_id)        
        INNER JOIN images ON turbina.t_id=images.t_id)
        INNER JOIN arak ON turbina.t_id=arak.t_id)
        WHERE images.alap =1 ORDER BY t_id ASC LIMIT $kezd, $lim;";

        $eredmeny = mysqli_query($conn, $sql2);    
        return $eredmeny;

    }

    function tablaTartalom_kereskedelmi($kezd, $lim)
    {
        global $conn;
        require('./config.php');
        $db = $dbname;

        $sql2 = "SELECT `turbina`.t_id, turbina.nev, turbina.gep, category.kat_nev1, category.kat_nev2, arak.ar, images.path, images.alt
        FROM (((`$db`.`turbina`         
        INNER JOIN category ON turbina.kat=category.kat_id)        
        INNER JOIN images ON turbina.t_id=images.t_id)
        INNER JOIN arak ON turbina.t_id=arak.t_id)
        WHERE images.alap =1 AND category.kat_nev1 = 'Kereskedelmi' ORDER BY t_id ASC LIMIT $kezd, $lim;";

        $eredmeny = mysqli_query($conn, $sql2);
        return $eredmeny;
    }


    function tablaTartalom_katonai($kezd, $lim)
    {
        global $conn;
        require('./config.php');
        $db = $dbname;

        $sql2 = "SELECT `turbina`.t_id, turbina.nev, turbina.gep, category.kat_nev1, category.kat_nev2, arak.ar, images.path, images.alt
        FROM (((`$db`.`turbina`         
        INNER JOIN category ON turbina.kat=category.kat_id)        
        INNER JOIN images ON turbina.t_id=images.t_id)
        INNER JOIN arak ON turbina.t_id=arak.t_id)
        WHERE images.alap =1 AND category.kat_nev1 = 'Katonai' ORDER BY t_id ASC LIMIT $kezd, $lim;";

        $eredmeny = mysqli_query($conn, $sql2);
        return $eredmeny;
    }

    function tablaTartalom_ipari($kezd, $lim)
    {
        global $conn;
        require('./config.php');
        $db = $dbname;

        $sql2 = "SELECT `turbina`.t_id, turbina.nev, turbina.gep, category.kat_nev1, category.kat_nev2, arak.ar, images.path, images.alt
        FROM (((`$db`.`turbina`         
        INNER JOIN category ON turbina.kat=category.kat_id)        
        INNER JOIN images ON turbina.t_id=images.t_id)
        INNER JOIN arak ON turbina.t_id=arak.t_id)
        WHERE images.alap =1 AND category.kat_nev1 = 'Ipari gázturbina' ORDER BY t_id ASC LIMIT $kezd, $lim;";

        $eredmeny = mysqli_query($conn, $sql2);
        return $eredmeny;
    }


    function teljesTartalom($azonosit)
    {
        global $conn;
        require('./config.php');
        $db = $dbname;

        $sql2 = "SELECT 
                `turbina`.t_id, 
                turbina.nev, 
                turbina.toloero,
                turbina.teljesit,
                turbina.bpr,                
                turbina.nyomasarany,
                turbina.hossz,
                turbina.ventilator_atmero,
                turbina.suly,
                turbina.gep, 
                turbina.extras, 
                turbina.descript, 
                category.kat_nev1, 
                category.kat_nev2, 
                arak.ar, 
                images.path, 
                images.alt
        FROM (((`$db`.`turbina`         
        INNER JOIN category ON turbina.kat=category.kat_id)        
        INNER JOIN images ON turbina.t_id=images.t_id)
        INNER JOIN arak ON turbina.t_id=arak.t_id)
        WHERE turbina.t_id = $azonosit AND images.alap =1;";

        $eredmeny = mysqli_query($conn, $sql2);
        return $eredmeny;
    }


    function kepek_sql($azonosit)
    {
        global $conn;
        require('./config.php');
        $db = $dbname;

        $sql3 = "SELECT 
                `turbina`.t_id,               
                images.path, 
                images.alt
        FROM (`$db`.`turbina`  
        INNER JOIN images ON turbina.t_id=images.t_id)       
        WHERE turbina.t_id = $azonosit ORDER BY kep_id ASC;";

        $kepek = mysqli_query($conn, $sql3);
        return $kepek;
    }

    ?>

