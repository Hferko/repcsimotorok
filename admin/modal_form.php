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

function osszes_adat($azonosito)
{
    $conn = nyit();
    require('../config.php');
    $db = $dbname;

    $sql = "SELECT 
                turbina.t_id,
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
                arak.ig, 
                images.path, 
                images.alt
        FROM (((`$db`.`turbina`
        INNER JOIN category ON turbina.kat=category.kat_id)        
        INNER JOIN images ON turbina.t_id=images.t_id)
        INNER JOIN arak ON turbina.t_id=arak.t_id)
        WHERE `turbina`.t_id= '" . $azonosito . "'AND images.alap =1;";

    $turbina_adatok = mysqli_query($conn, $sql);
    return $turbina_adatok;
}


function form_rajz($sor){

  echo '<div class="row  mb-3">
                      <div class="col">
                        <div class="form-group">
                          <label>Tolóerő</label>
                          <input class="form-control" type="text" name="tolo" id="tolo" value="' . $sor["toloero"] . '">
                        </div>
                      </div>';

  echo '<div class="col">
                        <div class="form-group">
                          <label>Teljesitmény</label>
                          <input class="form-control" type="text" name="telj" id="telj" value="' . $sor["teljesit"] . '">
                        </div>
                      </div>';

  echo '<div class="col">
                        <div class="form-group">
                          <label>Nyomásarány</label>
                          <input class="form-control" type="text" name="press" id="press" value="' . $sor["nyomasarany"] . '">
                        </div>
                      </div>';

  echo '<div class="col">
                        <div class="form-group">
                          <label>Bypass-arány</label>
                          <input class="form-control" type="text" name="bpr" id="bpr" value="' . $sor["bpr"] . '">
                        </div>
                      </div>
                    </div>';

  echo '<div class="row  mb-3">
                      <div class="col">
                        <div class="form-group">
                          <label>Hossz</label>
                          <input class="form-control" type="text" name="hossz" id="hossz" value="' . $sor["hossz"] . '">
                        </div>
                      </div>';

  echo '<div class="col">
                        <div class="form-group">
                          <label>Átmérő</label>
                          <input class="form-control" type="text" name="dia" id="dia" value="' . $sor["ventilator_atmero"] . '">
                        </div>
                      </div>';

  echo '<div class="col">
                        <div class="form-group">
                          <label>Súly</label>
                          <input class="form-control" type="text" name="suly" id="suly" value="' . $sor["suly"] . '">
                        </div>
                      </div>';

  echo '</div>
                    <div class="row">
                      <div class="col mb-3">
                        <div class="form-group">
                          <label>Alkalmazása</label>
                          <textarea class="form-control" name="alkalmaz" rows="3">' . $sor["gep"] . '</textarea>
                        </div>
                      </div>
                    </div>';

  echo '<div class="row">
                      <div class="col mb-3">
                        <div class="form-group">
                          <label>Részletek</label>
                          <textarea class="form-control" name="reszlet" rows="4">' . $sor["extras"] . '</textarea>
                        </div>
                      </div>
                    </div>';

  echo '<div class="row">
                      <div class="col mb-3">
                        <div class="form-group">
                          <label>Leírás</label>
                          <textarea class="form-control" name="leir" rows="6">' . $sor["descript"] . '</textarea>
                        </div>
                      </div>
                    </div>';

}

if (isset($_GET["azonosito"])) {
    $ID = (int)$_GET["azonosito"];

    $osszes_adat = osszes_adat($ID);

    while ($sor = mysqli_fetch_array($osszes_adat)) {
    form_rajz($sor);
    }
}

if (isset($_GET["kep"])) {
  $ID = (int)$_GET["kep"];
    $osszes_adat = osszes_adat($ID);
    while ($sor = mysqli_fetch_array($osszes_adat)) {
      echo '../assets/product/'.$sor["path"];
    }
}

?>
