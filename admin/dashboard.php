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
  if (isset($_SESSION["turbina_id"])) {
    unset($_SESSION['turbina_id']);
  }
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
            <li class="nav-item"><a class="nav-link active" href="dashboard.php">Hajtóművek</a></li>
            <li class="nav-item"><a class="nav-link text-light" href="szamla_admin.php">Számlák</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="felhasznalok.php">Felhasználók</a></li>
          </ul>
        </div>

        <div class="row flex-lg-nowrap">
          <div class="col mb-3">
            <div class="e-panel card">
              <div class="card-body">

                <?php

                // Definiált változók
                $limit = 8;
                $header = ['ID', 'Fotó', 'Tipus', 'Kategória', 'Ár', 'Érvényes', ''];


                if (isset($_GET["oldal"])) {
                  $aktual_oldal  = $_GET["oldal"];
                } else {
                  $aktual_oldal = 1;
                };
                $kezdes = ($aktual_oldal - 1) * $limit;

                $sorokSzama = sorokSzama();
                $eredmeny = tablaTartalom($kezdes, $limit);

                if (!$eredmeny) {
                  print(mysqli_error($conn) . ' ' . mysqli_errno($conn));
                } else {
                  echo '<div class="text-center px-xl-3">';
                  echo '<button class="btn btn-info btn-block btn-lg" type="button" data-toggle="modal" data-target="#insert-modal"><b>&#9881; &nbsp; ÚJ TURBINA FELVÉTELE &nbsp; &#9998;</b></button></div>';

                  pager($limit, $aktual_oldal, $sorokSzama);
                  tablaRajz($eredmeny, $header);

                  pager($limit, $aktual_oldal, $sorokSzama);
                }
                ?>

              </div>
            </div>
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
            <form class="form" name="modosit" method="POST" action="edit.php">
              <div class="row">
                <div class="col">
                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">

                        <input type="hidden" name="id" id="id" readonly>

                        <label>Típus</label>
                        <input class="form-control" type="text" name="tipus" id="tipus" readonly>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Kategória</label>
                        <input class="form-control" type="text" name="kategoria" id="kategoria" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Ára (&#8364;)</label>
                        <input class="form-control" type="text" name="ara" id="ara" value="">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Érvényesség ideje</label>
                        <input class="form-control" type="text" name="ervenyes" id="ervenyes" autofocus>
                      </div>
                    </div>
                  </div>
                  <!--- ! ! --->
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
          <h5 class="modal-title text-danger"><b>Termék törlése</b></h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true" class="text-danger">&#10008;</span>
          </button>
        </div>
        <div class="modal-body" data-bs-spy="scroll" data-bs-offset="0" class="scrollspy-example" tabindex="0">
          <div class="py-1">
            <form class="form" name="torol" method="POST" action="torol.php">
              <div class="row">
                <div class="col">
                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">

                        <label>Típus</label>
                        <input class="form-control" type="text" name="tipus1" id="tipus1" readonly>
                      </div>
                    </div>
                    <div class=" col">
                      <div class="form-group">
                        <label>Kategória</label>
                        <input class="form-control" type="text" name="kategoria1" id="kategoria1" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Ára (&#8364;)</label>
                        <input class="form-control" type="text" name="ara1" id="ara1" readonly>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Érvényesség ideje</label>
                        <input class="form-control" type="text" name="ervenyes1" id="ervenyes1" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="form-group">
                  <label>ID: </label>
                  <input type="text" name="id1" id="id1" size="4" readonly>
                </div>
                <img src="" class="rounded float-end" id="kep" style="width:60%;height:auto;">
              </div>
              <div class="row">
                <div class="col d-flex justify-content-start">
                  <p class="text-danger">A fent jelölt típusú turbina minden adata törlődni fog az adatbázisból.<br>
                    Biztos folytatja?</p>
                </div>
              </div>
              <div class="row">
                <div class="col d-flex justify-content-end">
                  <button class="btn btn-danger" type="submit">ADATOK TÖRLÉSE</button>
                </div>
              </div>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--- ! I N S E R T  modal ! --->
  <div class="modal fade" role="dialog" tabindex="-1" id="insert-modal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-light">Új termék felvétele</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true" class="text-danger">&#10008;</span>
          </button>
        </div>
        <div class="modal-body" data-bs-spy="scroll" data-bs-offset="0" class="scrollspy-example" tabindex="0">
          <div class="py-1">
            <form class="form" name="insert" method="POST" action="insert.php">
              <div class="row">
                <div class="col">
                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">

                        <label>Típus</label>
                        <input class="form-control" type="text" name="tipus3" id="tipus3" required>
                      </div>
                    </div>
                    <div class=" col">
                      <div class="form-group">
                        <label>Kategória</label>
                        <select class="form-select form-control" name="kategoria3" required>
                          <option class="betu" value="" selected>Válassza ki a motor kategóriáját:</option>
                          <option class="betu" value="1">Kereskedelmi, Szélestestű Jet motor</option>
                          <option class="betu" value="2">Kereskedelmi, Keskenytestű Jet motor</option>
                          <option class="betu" value="3">Kereskedelmi, Üzleti repülőgép motor</option>
                          <option class="betu" value="4">Kereskedelmi Turbo-propeller hajtómű</option>
                          <option class="betu" value="5">Kereskedelmi Helikopter motor</option>
                          <option class="betu" value="6">Katonai Vadászgép motor</option>
                          <option class="betu" value="7">Katonai Harci helikopter motor</option>
                          <option class="betu" value="8">Katonai Szállító repülőgép</option>
                          <option class="betu" value="9">Ipari gázturbina</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Ára &#8364;-ban, <small><i> (csak a számértéket adja meg)</i></small></label>
                        <input class="form-control" type="text" name="ara3" id="ara3" placeholder="00000,0" required>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Érvényesség ideje</label>
                        <input class="form-control" type="text" name="ervenyes3" id="ervenyes3" placeholder="2022-01-02" required>
                      </div>
                    </div>
                  </div>
                  <!--- ! ! --->
                  <?php form_rajz(); ?>
                </div>
              </div>

              <div class="row">
                <div class="col d-flex justify-content-end">
                  <button class="btn btn-success" type="submit">VÁLTOZTATÁSOK MENTÉSE</button>
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
        let tipus = tableRow.childNodes[2].innerHTML;
        let ara = tableRow.childNodes[4].innerHTML;
        let kategoria = tableRow.childNodes[3].innerHTML;
        let ervenyes = tableRow.childNodes[5].innerHTML;
        let id = tableRow.childNodes[0].innerHTML;
        let obj = {
          'tipus': tipus,
          'ara': ara,
          'kategoria': kategoria,
          'ervenyes': ervenyes,
          'id': id
        };
        console.log(obj);
        id_atad(obj.id);

        document.getElementById("tipus").value = obj.tipus;
        document.getElementById("ara").value = obj.ara;
        document.getElementById("kategoria").value = obj.kategoria;
        document.getElementById("ervenyes").value = obj.ervenyes;
        document.getElementById("id").value = obj.id;
      }
    }


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
        let tipus = tableRow.childNodes[2].innerHTML;
        let ara = tableRow.childNodes[4].innerHTML;
        let kategoria = tableRow.childNodes[3].innerHTML;
        let ervenyes = tableRow.childNodes[5].innerHTML;
        let id = tableRow.childNodes[0].innerHTML;

        let obj = {
          'tipus': tipus,
          'ara': ara,
          'kategoria': kategoria,
          'ervenyes': ervenyes,
          'id': id
        };
        console.log(obj);
        id_atad2(obj.id);

        document.getElementById("tipus1").value = obj.tipus;
        document.getElementById("ara1").value = obj.ara;
        document.getElementById("kategoria1").value = obj.kategoria;
        document.getElementById("ervenyes1").value = obj.ervenyes;
        document.getElementById("id1").value = obj.id;
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