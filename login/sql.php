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
   

    function sorokSzama(){
        global $conn;     
        require('../config.php');
        $db = $dbname;

        $sql = "SELECT t_id FROM `$db`.turbina;";   

        if(!mysqli_query($conn, $sql)){
            print("Az adattábla nem nyitható meg<br>");
            return "";
        }
        else{
            $result = mysqli_query($conn, $sql);
            $sorok = mysqli_num_rows($result);

            echo '<p class="fs-6">Ennyi motor található jelenleg a turbinák adatbázisában: ' . $sorok . '</p>';
            return $sorok;
        }        
    }    

    function tablaTartalom($kezd, $lim){        
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

    function utolso_adat($tabla, $mezo){
        global $conn;
        require('../config.php');
        $db = $dbname;

        $sql3 = "SELECT MAX($mezo) AS maxi FROM `$db`.`$tabla`;";
        $result = mysqli_query($conn, $sql3);
        $sor = mysqli_fetch_array($result);
        $maxi = $sor["maxi"];

        if ($maxi === NULL) {            
            $maxi = 100;            
            return $maxi;

        } else {            
            $maxi = $sor["maxi"];                   
            return $maxi;
        }
        
    }   

    ?>

