<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="utf-8">
  <title>Repcsimotorok - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/templatemo.css">
  <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
  <script src="../assets/js/jquery-1.11.0.min.js"></script>
  <script src="../assets/js/bootstrap4.bundle.min.js"></script>

  <style type="text/css">
    body {
      /*margin-top: 20px;*/
      width: 100%;
      background: linear-gradient(to right, peru 0%, beige 100%);
    }

    img {
      margin: 0 auto;
      width: 100%;
      height: auto;
    }
  </style>

</head>

<body>
  <?php
  include('navig_admin.php');
  ?>

  <?php
  require('sql.php');
  require('fuggveny.php');
  require('sessions.php');

  $conn = nyit();
  $x = mgbox();
  unset($_SESSION['rendben']);
  unset($_SESSION['fail']);
  unset($_SESSION['hiba']);

  ?>
  <div class="container-xxl p-5">

    <!-- class="col-12 col-lg-auto mb-3"-->
    <div class="row flex-lg-nowrap">

      <div class="col pt-4">
        <div class="e-tabs mb-3 px-3">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link text-light" href="dashboard.php">Hajtóművek</a></li>
            <li class="nav-item"><a class="nav-link active" href="szamla_admin.php">Számlák</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="felhasznalok.php">Felhasználók</a></li>
          </ul>
        </div>

        <div class="row flex-lg-nowrap">
          <div class="col mb-3">
            <div class="e-panel card">
              <div class="card-body">

                <?php

                // Definiált változók
                $limit = 4;
                $header = ['', 'Tétel', 'Számlasz.', 'Vasarló', 'Termek', 'Egys.Ár', 'Mennyiség', 'Turbinák ára', 'Kézbesítés', 'Fizetési mód', 'A SZÁMLA összértéke', 'Kiállítás dátuma', 'Megjegyzés', ''];


                if (isset($_GET["oldal"])) {
                  $aktual_oldal  = $_GET["oldal"];
                } else {
                  $aktual_oldal = 1;
                };
                $kezdes = ($aktual_oldal - 1) * $limit;

                $sorokSzama = szamlaSorok();
                $eredmeny = szamlaTabla($kezdes, $limit);

                if (!$eredmeny) {
                  print(mysqli_error($conn) . ' ' . mysqli_errno($conn));
                } else {

                  szamlaPager($limit, $aktual_oldal, $sorokSzama);
                  szamlakTabla($eredmeny, $header);

                  //szamlaPager($limit, $aktual_oldal, $sorokSzama);
                }
                ?>
              </div>
            </div>
            <?php szamlaPager($limit, $aktual_oldal, $sorokSzama); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--- - !  M O D A L O K  ! - --->
  <!---! Módosít modal !--->
  <div class="modal fade" role="dialog" tabindex="-1" id="modosit-modal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title">Adatok módosítása</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true" class="text-danger">&#10008;</span>
          </button>
        </div>
        <div class="modal-body" data-bs-spy="scroll" data-bs-offset="0" class="scrollspy-example" tabindex="0">
          <div class="py-1">
            <form class="form" name="modosit" method="POST" action="szamla_edit.php">
              <div class="row">
                <div class="col">
                  <div class="row mb-3">
                    <div class="col-4">
                      <div class="form-group">

                        <label>Tételszám &#8470; </label>
                        <input class="form-control" type="text" name="tetel" id="tetel" readonly>
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="form-group">
                        <label>Kiállítás dátuma </label>
                        <input class="form-control" type="text" name="created" id="created" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Számla száma:</label>
                        <input class="form-control fs-5 fw-bold" type="text" name="szamlaszam" id="szamlaszam" readonly>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Vásárló e-mail címe</label>
                        <input class="form-control" type="text" name="email" id="email" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Termék megnevezése (&#8364;)</label>
                        <input class="form-control" type="text" name="tipus" id="tipus" readonly>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Egységára (&#8364;)</label>
                        <input class="form-control" type="text" name="egyseg_ar" id="egyseg_ar" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col-4">
                      <div class="form-group">
                        <label>Vásárolt mennyiség (db)</label>
                        <input class="form-control" type="number" min="1" max="5" name="mennyiseg" id="mennyiseg" value="">
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="form-group">
                        <label>Fizetendő (&#8364;)</label>
                        <input class="form-control" type="text" name="ossz_ar" id="ossz_ar" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Kézbesítés módja</label>
                        <input class="form-control" type="text" name="kezbesit" id="kezbesit" value="">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Fizetési mód</label>
                        <input class="form-control" type="text" name="fizet_mod" id="fizet_mod">
                      </div>
                    </div>
                  </div>
                  <div class="row  mb-3">
                    <div class="col-4">
                    </div>
                    <div class="col-8">
                      <div class="form-group">
                        <label>Számla értéke összesen (&#8364;)</label>
                        <input class="form-control fs-5" type="text" name="teljes_osszeg" id="teljes_osszeg" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <div class="form-group">
                        <label>Megjegyzés</label>
                        <textarea class="form-control" name="comment" id="comment" rows="2"></textarea>
                      </div>
                    </div>
                  </div>
                  <div id="tobb_adat"></div>
                </div>
              </div>

              <div class="row">
                <div class="col d-flex justify-content-end">
                  <button class="btn btn-primary" type="submit">VÁLTOZTATÁSOK MENTÉSE</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <hr>
      </div>
    </div>
    <br>
  </div>
  </div>

  <!---! T Ö  R Ö L modal !--->
  <div class="modal fade" role="dialog" tabindex="-1" id="torol-modal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title text-danger"><b>Termék törlése a kosárból</b></h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true" class="text-danger">&#10008;</span>
          </button>
        </div>
        <div class="modal-body" data-bs-spy="scroll" data-bs-offset="0" class="scrollspy-example" tabindex="0">
          <div class="py-1">
            <form class="form" name="torol" method="POST" action="szamla_torol.php">
              <div class="row">
                <div class="col">
                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">

                        <label>Tétel: </label>
                        <input class="form-control" type="text" name="tetel1" id="tetel1" readonly>
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="form-group">
                        <label>Kiállítás dátuma </label>
                        <input class="form-control" type="text" name="created1" id="created1" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Számla száma:</label>
                        <input class="form-control fs-5 fw-bold" type="text" name="szamlaszam1" id="szamlaszam1" readonly>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Vásárló e-mail címe</label>
                        <input class="form-control" type="text" name="email1" id="email1" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Termék megnevezése (&#8364;)</label>
                        <input class="form-control" type="text" name="tipus1" id="tipus1" readonly>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Egységára (&#8364;)</label>
                        <input class="form-control" type="text" name="egyseg_ar1" id="egyseg_ar1" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col-4">
                      <div class="form-group">
                        <label>Vásárolt mennyiség</label>
                        <input class="form-control" type="text" name="mennyiseg1" id="mennyiseg1" readonly>
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="form-group">
                        <label>Fizetendő (&#8364;)</label>
                        <input class="form-control" type="text" name="ossz_ar1" id="ossz_ar1" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col-4">
                      <label>Számla régi összeg:(&#8364;)</label>
                      <input class="form-control" type="text" name="teljes_osszeg1" id="teljes_osszeg1" readonly>
                    </div>
                    <div class="col-8">
                      <div class="form-group">
                        <label>Számla értéke a tétel törlés után:(&#8364;)</label>
                        <input class="form-control fs-5" type="text" name="csokkent" id="csokkent" readonly>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col d-flex justify-content-start">
                  <p class="text-danger">A fent jelölt tétel minden adata törlődni fog az adatbázisból, és a számla össz értéke is változik.<br>
                    Biztos folytatja?</p>
                </div>
              </div>
              <div class="row">
                <div class="col d-flex justify-content-end">
                  <button class="btn btn-danger" type="submit">ADATOK TÖRLÉSE</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--- ! Modalok vége  ! --->


  <script type="text/javascript">
    function modal_modosit() {

      // - A J A X ---->
      function id_atad(str) {
        if (str == "") {
          document.getElementById("tobb_adat").innerHTML = "";
          return;
        }
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tobb_adat").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("GET", "modal_form.php?azonosito=" + str, true);
        xmlhttp.send();
      }
      // <---- AJAX


      let table = document.getElementById("tablazat");
      if (table) {
        for (let i = 0; i < table.rows.length; i++) {
          table.rows[i].onclick = function() {
            tableText(this);
          };
        }
      }

      function tableText(tableRow) {
        let tetel = tableRow.childNodes[1].innerHTML;
        let created = tableRow.childNodes[11].innerHTML;
        let szamlaszam = tableRow.childNodes[2].innerHTML;
        let email = tableRow.childNodes[3].innerHTML;
        let tipus = tableRow.childNodes[4].innerHTML;
        let egyseg_ar = tableRow.childNodes[5].innerHTML;
        let mennyiseg = tableRow.childNodes[6].innerHTML;
        let ossz_ar = tableRow.childNodes[7].innerHTML;
        let kezbesit = tableRow.childNodes[8].innerHTML;
        let fizet_mod = tableRow.childNodes[9].innerHTML;
        let teljes_osszeg = tableRow.childNodes[10].innerHTML;
        let comment = tableRow.childNodes[12].innerHTML;

        let obj = {
          'tetel': tetel,
          'created': created,
          'szamlaszam': szamlaszam,
          'email': email,
          'tipus': tipus,
          'egyseg_ar': egyseg_ar,
          'mennyiseg': mennyiseg,
          'ossz_ar': ossz_ar,
          'kezbesit': kezbesit,
          'fizet_mod': fizet_mod,
          'teljes_osszeg': teljes_osszeg,
          'comment': comment
        };
        console.log(obj);
        id_atad(obj.id);

        document.getElementById("tetel").value = obj.tetel;
        document.getElementById("created").value = obj.created;
        document.getElementById("szamlaszam").value = obj.szamlaszam;
        document.getElementById("email").value = obj.email;
        document.getElementById("tipus").value = obj.tipus;
        document.getElementById("egyseg_ar").value = obj.egyseg_ar;
        document.getElementById("mennyiseg").value = obj.mennyiseg;
        document.getElementById("ossz_ar").value = obj.ossz_ar;
        document.getElementById("kezbesit").value = obj.kezbesit;
        document.getElementById("fizet_mod").value = obj.fizet_mod;
        document.getElementById("teljes_osszeg").value = obj.teljes_osszeg;
        document.getElementById("comment").value = obj.comment;
      }
    }
    //   ---------------------------
    
    function modal_torol() {
      // - A J A X ---->
      function id_atad2(str) {
        if (str == "") {
          document.getElementById("kep").src = "";
          return;
        }
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("kep").src = this.responseText;
          }
        }
        xmlhttp.open("GET", "modal_form.php?kep=" + str, true);
        xmlhttp.send();
      }
      // <---- AJAX

      let table = document.getElementById("tablazat");
      if (table) {
        for (let i = 0; i < table.rows.length; i++) {
          table.rows[i].onclick = function() {
            tableText(this);
          };
        }
      }

      function tableText(tableRow) {
        let tetel = tableRow.childNodes[1].innerHTML;
        let created = tableRow.childNodes[11].innerHTML;
        let szamlaszam = tableRow.childNodes[2].innerHTML;
        let email = tableRow.childNodes[3].innerHTML;
        let tipus = tableRow.childNodes[4].innerHTML;
        let egyseg_ar = tableRow.childNodes[5].innerHTML;
        let mennyiseg = tableRow.childNodes[6].innerHTML;
        let ossz_ar = tableRow.childNodes[7].innerHTML;
        let teljes_osszeg = tableRow.childNodes[10].innerHTML;
        let csokkent = tableRow.childNodes[13].innerHTML;

        let obj1 = {
          'tetel': tetel,
          'created': created,
          'szamlaszam': szamlaszam,
          'email': email,
          'tipus': tipus,
          'egyseg_ar': egyseg_ar,
          'mennyiseg': mennyiseg,
          'ossz_ar': ossz_ar,
          'teljes_osszeg': teljes_osszeg,
          'csokkent': csokkent
        };
        console.log(obj1);

        document.getElementById("tetel1").value = obj1.tetel;
        document.getElementById("created1").value = obj1.created;
        document.getElementById("szamlaszam1").value = obj1.szamlaszam;
        document.getElementById("email1").value = obj1.email;
        document.getElementById("tipus1").value = obj1.tipus;
        document.getElementById("egyseg_ar1").value = obj1.egyseg_ar;
        document.getElementById("mennyiseg1").value = obj1.mennyiseg;
        document.getElementById("ossz_ar1").value = obj1.ossz_ar;
        document.getElementById("teljes_osszeg1").value = obj1.teljes_osszeg;
        document.getElementById("csokkent").value = obj1.csokkent;
      }
    }
  </script>

  <?php
  if (mysqli_close($conn)) {
    echo "<hr style='margin-top:10px;'><br> &nbsp; A MySql kapcsolat bontva";
  } else {
    echo "<hr style='margin-top:10px;'><br> &nbsp; A kapcsolat a szerverel még él !!";
  }
  ?>
  <!-- Start Script -->
  <script src="../assets/js/jquery-1.11.0.min.js"></script>
  <script src="../assets/js/jquery-migrate-1.2.1.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/templatemo.js"></script>
  <script src="../assets/js/custom.js"></script>
  <!-- End Script -->
</body>

</html>