<?php

function pager($limit, $oldal, $sorokSzama)
{
    $ossz_oldal = ceil($sorokSzama / $limit);

    $oldalLink = '<ul class="pagination mt-3 mb-0">';
    for ($i = 1; $i <= $ossz_oldal; $i++) {

        if ($i == $oldal) {
            $oldalLink .= '<li class="active page-item"><a class="page-link" href="dashboard.php?oldal=' . $i . '">' . $i . "</a></li>";
        } else {
            $oldalLink .= '<li class="page-item"><a class="page-link" href="dashboard.php?oldal=' . $i . '">' . $i . "</a></li>";
        }
    }
    echo $oldalLink . "</ul><br>";
}

function userPager($limit, $oldal, $sorokSzama)
{
  $ossz_oldal = ceil($sorokSzama / $limit);

  $oldalLink = '<ul class="pagination mt-3 mb-0">';
  for ($i = 1; $i <= $ossz_oldal; $i++) {

    if ($i == $oldal) {
      $oldalLink .= '<li class="active page-item"><a class="page-link" href="felhasznalok.php?oldal=' . $i . '">' . $i . "</a></li>";
    } else {
      $oldalLink .= '<li class="page-item"><a class="page-link" href="felhasznalok.php?oldal=' . $i . '">' . $i . "</a></li>";
    }
  }
  echo $oldalLink . "</ul><br>";
}

function szamlaPager($limit, $oldal, $sorokSzama)
{
  $ossz_oldal = ceil($sorokSzama / $limit);

  $oldalLink = '<ul class="pagination mt-3 mb-0">';
  for ($i = 1; $i <= $ossz_oldal; $i++) {

    if ($i == $oldal) {
      $oldalLink .= '<li class="active page-item"><a class="page-link" href="szamla_admin.php?oldal=' . $i . '">' . $i . "</a></li>";
    } else {
      $oldalLink .= '<li class="page-item"><a class="page-link" href="szamla_admin.php?oldal=' . $i . '">' . $i . "</a></li>";
    }
  }
  echo $oldalLink . "</ul><br>";
}


function tablaRajz($ered, array $header)
{
    // --- A táblázat ------    
    $countHead =  count($header);

    //Táblázat fejléce
    echo '<div class="e-table">
    <div class="table-responsive table-lg mt-3">
      <table class="table table-striped table-hover table-bordered border-info" id="tablazat">
        <thead>
          <tr>';

    for ($i = 0; $i < $countHead; $i++) {
        echo ('<th class="align-top">' . $header[$i] . '</th>');
    };
    echo "</tr> </thead> <tbody>";

    while ($row = mysqli_fetch_array($ered)) {

        // ellenőrzöm, hogy az adott mezőben van-e adat
        if (empty($row['kat_nev2'])) {
            $row['kat_nev2'] = '-';
        }

        if (empty($row['ar'])) {
            $row['ar'] = '0 &#8364;';
        }

        if (empty($row['ig'])) {
            $row['ig'] = '2222-02-22';
        }

        echo "<tr>";
        echo '<td class="align-middle">' . $row["t_id"] . "</td>";
        echo '<td class="align-middle text-center">';
        echo '<div class="bg-light d-inline-flex justify-content-center align-items-center align-top"
             style="width: 35px; height: 35px; border-radius: 3px;"> <img src="../assets/product/' . $row["path"] . '" alt="' . $row["alt"] . '"></div>
             </td>';
        echo '<td class="text-nowrap align-middle">' . $row["nev"] . "</td>";
        echo '<td class="align-middle">' . $row["kat_nev1"] . " - " . $row["kat_nev2"] . "</td>";
        echo '<td class="text-nowrap text-center align-middle">' . $row["ar"] . " &#8364;</td>"; //number_format(($row["ar"]), 2, ', ', ' ') . " &#8364;
        echo '<td class="text-center align-middle">' . $row["ig"] . "</td>";
        echo '<td class="text-center align-middle">';
        echo '<div class="btn-group align-top">';
        echo '<button class="btn btn-sm btn-outline-success" type="button" data-toggle="modal"
             data-target="#modosit-modal" onclick="modal_modosit()">MÓDOSÍT</button>

             <button class="btn btn-sm btn-outline-danger" type="button" data-toggle="modal"
             data-target="#torol-modal" onclick="modal_torol()"><i class="fa fa-trash"></i></button>';
        echo '</div></td>';
    }
    echo "</table>";
}

function felhasznaloTabla($ered, array $header)
{
  // --- A táblázat ------    
  $countHead =  count($header);

  //Táblázat fejléce
  echo '<div class="e-table">
    <div class="table-responsive table-lg mt-3 fs-6">
      <table class="table table-striped table-hover table-bordered border-info" id="tablazat">
        <thead>
          <tr>';

  for ($i = 0; $i < $countHead; $i++) {
    echo ('<th class="align-top">' . $header[$i] . '</th>');
  };
  echo "</tr> </thead> <tbody>";

  while ($row = mysqli_fetch_array($ered)) {
   
    if (empty($row['vez_nev'])) {
      $row['vez_nev'] = 'Még nem vásárolt';
    }

    if (empty($row['ker_nev'])) {
      $row['ker_nev'] = '-';
    }

    if (empty($row['telefon'])) {
      $row['telefon'] = '-';
    }

    if (empty($row['ir_szam'])) {
      $row['ir_szam'] = '-';
    }

    if (empty($row['varos'])) {
      $row['varos'] = '-';
    }

    if (empty($row['cim'])) {
      $row['cim'] = '-';
    }

    if (empty($row['ip_cim'])) {
      $row['ip_cim'] = '-';
    }

    if (empty($row['status'])) {
      $row['status'] = 'vasarlo';
    }

    echo "<tr>";
    echo '<td class="text-center align-middle">';
    echo '<div class="btn-group align-top">';
    echo '<button class="btn btn-sm btn-outline-success" type="button" data-toggle="modal"
             data-target="#modosit-modal" onclick="modal_modosit()">MÓDOSÍT</button>
             <button class="btn btn-sm btn-outline-danger" type="button" data-toggle="modal"
             data-target="#torol-modal" onclick="modal_torol()"><i class="fa fa-trash"></i></button>';
    echo '</div></td>';
    echo '<td class="align-middle">' . $row["felhasznalo_id"] . "</td>";
    echo '<td class="align-middle text-center">'. $row["neve"] .'</td>';
    echo '<td class="align-middle text-center">' . $row['status'] . '</td>';    
    echo '<td class="text-nowrap align-middle">' . $row["email"] . "</td>";    
    echo '<td class="text-nowrap text-center align-middle">' . $row["reg_datum"] . "</td>";
    echo '<td class="text-center align-middle">' . $row["latest"] . "</td>";
    echo '<td class="align-middle">' . $row["vez_nev"] . "</td>";
    echo '<td class="align-middle">' . $row["ker_nev"] . "</td>";
    echo '<td class="align-middle">' . $row["telefon"] . "</td>";
    echo '<td class="align-middle">' . $row["varos"] . "</td>";
    echo '<td class="align-middle">' . $row["cim"] . "</td>";
    echo '<td class="align-middle">' . $row["ip_cim"] . "</td>";    
    echo '</tr>';
  }
  echo "</table>";
}

function szamlakTabla($ered, array $header)
{
  // --- A táblázat ------    
  $countHead =  count($header);

  //Táblázat fejléce
  echo '<div class="e-table">
    <div class="table-responsive table-lg mt-3">
      <table class="table table-striped table-hover table-bordered border-info" id="tablazat">
        <thead>
          <tr>';

  for ($i = 0; $i < $countHead; $i++) {
    echo ('<th class="align-top text-center">' . $header[$i] . '</th>');
  };
  echo "</tr> </thead> <tbody>";

  while ($row = mysqli_fetch_array($ered)) {

    if (empty($row['kezbesit'])) {
      $row['kezbesit'] = 'Házhoz szállítás';
    }

    if (empty($row['fizet_mod'])) {
      $row['fizet_mod'] = 'behajtóval';
    }

    if (empty($row['comment'])) {
      $row['comment'] = '-';
    }
    
    $csokkent = $row["teljes_osszeg"] - $row["ossz_ar"];
    echo "<tr>";
    echo '<td class="text-center align-middle">';
    echo '<div class="btn-group align-top">';
    echo
    '<button class="btn btn-sm btn-outline-success" type="button" data-toggle="modal"
             data-target="#modosit-modal" onclick="modal_modosit()">MÓDOSÍT</button>
             <button class="btn btn-sm btn-outline-danger" type="button" data-toggle="modal"
             data-target="#torol-modal" onclick="modal_torol()"><i class="fa fa-trash"></i></button>';
    echo '</div></td>';
    echo '<td class="align-middle">' . $row["tetel"] . "</td>";
    echo '<td class="align-middle text-center fs-5">' . $row["szamlaszam"] . '</td>';
    echo '<td class="text-nowrap align-middle text-center">' . $row['email'] . '</td>';
    echo '<td class="text-nowrap align-middle">' . $row["tipus"] . "</td>";
    echo '<td class="text-nowrap align-middle">' . $row["egyseg_ar"] . "</td>";
    echo '<td class="text-center align-middle">' . $row["mennyiseg"] . "</td>";
    echo '<td class="text-nowrap text-center align-middle">' . $row["ossz_ar"] . "</td>";
    echo '<td class="text-center align-middle">' . $row["kezbesit"] . "</td>";
    echo '<td class="text-center align-middle">' . $row["fizet_mod"] . "</td>";
    echo '<td class="text-nowrap text-center align-middle">' . $row["teljes_osszeg"] . "</td>";

    echo '<td class="text-center align-middle">' . $row["created"] . "</td>";
    echo '<td class="text-center align-middle">' . $row["comment"] . "</td>";
    echo '<td style="visibility: hidden; font-size:1px;" class="p-0">' .  $csokkent . "</td>";
    echo '</tr>';
  }
  echo "</table>";
}


function form_rajz()
{
    echo '<div class="row  mb-3">
                      <div class="col">
                        <div class="form-group">
                          <label>Tolóerő</label>
                          <input class="form-control" type="text" name="tolo" id="tolo" placeholder="00 Nm">
                        </div>
                      </div>';

    echo '<div class="col">
                        <div class="form-group">
                          <label>Teljesitmény</label>
                          <input class="form-control" type="text" name="telj" id="telj" placeholder="00 kW">
                        </div>
                      </div>';

    echo '<div class="col">
                        <div class="form-group">
                          <label>Nyomásarány</label>
                          <input class="form-control" type="text" name="press" id="press" >
                        </div>
                      </div>';

    echo '<div class="col">
                        <div class="form-group">
                          <label>Bypass-arány</label>
                          <input class="form-control" type="text" name="bpr" id="bpr">
                        </div>
                      </div>
                    </div>';

    echo '<div class="row  mb-3">
                      <div class="col">
                        <div class="form-group">
                          <label>Hossz</label>
                          <input class="form-control" type="text" name="hossz" id="hossz" placeholder="00 mm">
                        </div>
                      </div>';

    echo '<div class="col">
                        <div class="form-group">
                          <label>Átmérő</label>
                          <input class="form-control" type="text" name="dia" id="dia" placeholder="00 mm">
                        </div>
                      </div>';

    echo '<div class="col">
                        <div class="form-group">
                          <label>Súly</label>
                          <input class="form-control" type="text" name="suly" id="suly" placeholder="00 kg">
                        </div>
                      </div>';

    echo '</div>
                    <div class="row">
                      <div class="col mb-3">
                        <div class="form-group">
                          <label>Alkalmazása</label>
                          <textarea class="form-control" name="alkalmaz" rows="3">...gépeken alkalmazzák a motort </textarea>
                        </div>
                      </div>
                    </div>';

    echo '<div class="row">
                      <div class="col mb-3">
                        <div class="form-group">
                          <label>Részletek</label>
                          <textarea class="form-control" name="reszlet" rows="4">A motor jellemzői...</textarea>
                        </div>
                      </div>
                    </div>';

    echo '<div class="row">
                      <div class="col mb-3">
                        <div class="form-group">
                          <label>Leírás</label>
                          <textarea class="form-control" name="leir" rows="6">További tulajdonságok...</textarea>
                        </div>
                      </div>
                    </div>';
}