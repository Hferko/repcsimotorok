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
            <li class="nav-item"><a class="nav-link text-light" href="szamla_admin.php">Számlák</a></li>
            <li class="nav-item"><a class="nav-link active" href="felhasznalok.php">Felhasználók</a></li>
          </ul>
        </div>

        <div class="row flex-lg-nowrap">
          <div class="col mb-3">
            <div class="e-panel card">
              <div class="card-body">

                <?php

                // Definiált változók
                $limit = 8;
                $header = ['Művelet', 'ID', 'Felhasználónév', 'Státusz', 'E-mail', 'Regisztrálás dátuma', 'Utolsó belépés', 'Vezetéknév', 'Utónév', 'Telefon,', 'Város', 'Cím', 'IP cím'];


                if (isset($_GET["oldal"])) {
                  $aktual_oldal  = $_GET["oldal"];
                } else {
                  $aktual_oldal = 1;
                };
                $kezdes = ($aktual_oldal - 1) * $limit;

                $sorokSzama = userSorok();
                $eredmeny = userTabla($kezdes, $limit);

                if (!$eredmeny) {
                  print(mysqli_error($conn) . ' ' . mysqli_errno($conn));
                } else {                 
                  userPager($limit, $aktual_oldal, $sorokSzama);
                  felhasznaloTabla($eredmeny, $header);
                  //userPager($limit, $aktual_oldal, $sorokSzama);
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
            <form class="form" name="modosit" method="POST" action="user_edit.php">
              <div class="row">
                <div class="col">
                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">

                        <input type="hidden" name="id" id="id" readonly>

                        <label>Felhasználónév</label>
                        <input class="form-control" type="text" name="neve" id="neve">
                      </div>
                    </div>

                    <div class="col">
                      <div class="form-group">
                        <label>E-mail címe</label>
                        <input class="form-control" type="text" name="email" id="email">
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>IP címe</label>
                        <input class="form-control" type="text" name="ip" id="ip">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Regisztrálás dátuma</label>
                        <input class="form-control" type="text" name="reg" id="reg">
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Státusza: </label>
                        <input class="form-control" type="text" name="status" id="status">
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Vezetéknév</label>
                        <input class="form-control" type="text" name="vez_nev" id="vez_nev">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Utónév</label>
                        <input class="form-control" type="text" name="ker_nev" id="ker_nev">
                      </div>
                    </div>
                  </div>

                  <div class="row  mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Telefon</label>
                        <input class="form-control" type="text" name="telefon" id="telefon">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Település</label>
                        <input class="form-control" type="text" name="varos" id="varos">
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>Postacím </label>
                        <input class="form-control" type="text" name="cim" id="cim">
                      </div>
                    </div>
                  </div>
                 
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
      </div>
    </div>
  </div>
  </div>

  <!------! T Ö  R Ö L modal !------->
  <div class="modal fade" role="dialog" tabindex="-1" id="torol-modal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title text-danger"><b>Felhasználó törlése</b></h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true" class="text-danger">&#10008;</span>
          </button>
        </div>
        <div class="modal-body" data-bs-spy="scroll" data-bs-offset="0" class="scrollspy-example" tabindex="0">
          <div class="py-1">
            <form class="form" name="torol" method="POST" action="user_torol.php">
              <div class="row">
                <div class="col">
                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">

                        <label>Felhasználónév</label>
                        <input class="form-control" type="text" name="neve1" id="neve1" readonly>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>E-mail címe</label>
                        <input class="form-control" type="text" name="email1" id="email1" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col">
                      <div class="form-group">
                        <label>IP címe</label>
                        <input class="form-control" type="text" name="ip1" id="ip1" readonly>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Regisztrálás dátuma</label>
                        <input class="form-control" type="text" name="reg1" id="reg1" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <div class="form-group">
                    <label>Státusza: </label>
                    <input class="form-control" type="text" name="status1" id="status1" readonly>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>ID: </label>
                    <input class="form-control" type="text" name="id1" id="id1" size="4" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col d-flex justify-content-start">
                  <p class="text-danger">A felhasználó minden adata törlődni fog az adatbázisból.<br>
                    Biztos folytatja?</p>
                </div>
              </div>
              <div class="row">
                <div class="col d-flex justify-content-end">
                  <button class="btn btn-danger" type="submit">FELHASZNÁLÓ TÖRLÉSE</button>
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
            //document.getElementById("tobb_adat").innerHTML = this.responseText;
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
        let neve = tableRow.childNodes[2].innerHTML;
        let email = tableRow.childNodes[4].innerHTML;
        let reg = tableRow.childNodes[5].innerHTML;
        let status = tableRow.childNodes[3].innerHTML;
        let id = tableRow.childNodes[1].innerHTML;
        let vez_nev = tableRow.childNodes[7].innerHTML;
        let ker_nev = tableRow.childNodes[8].innerHTML;
        let telefon = tableRow.childNodes[9].innerHTML;
        let varos = tableRow.childNodes[10].innerHTML;
        let cim = tableRow.childNodes[11].innerHTML;
        let ip = tableRow.childNodes[12].innerHTML;
        let obj = {
          'neve': neve,
          'email': email,
          'reg': reg,
          'status': status,
          'id': id,
          'vez_nev': vez_nev,
          'ker_nev': ker_nev,
          'telefon': telefon,
          'varos': varos,
          'cim': cim,
          'ip': ip
        };
        console.log(obj);
        id_atad(obj.id);

        document.getElementById("neve").value = obj.neve;
        document.getElementById("email").value = obj.email;
        document.getElementById("ip").value = obj.ip;
        document.getElementById("reg").value = obj.reg;
        document.getElementById("status").value = obj.status;
        document.getElementById("id").value = obj.id;
        document.getElementById("vez_nev").value = obj.vez_nev;
        document.getElementById("ker_nev").value = obj.ker_nev;
        document.getElementById("telefon").value = obj.telefon;
        document.getElementById("varos").value = obj.varos;
        document.getElementById("cim").value = obj.cim;
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
        let neve = tableRow.childNodes[2].innerHTML;
        let email = tableRow.childNodes[4].innerHTML;
        let ip = tableRow.childNodes[12].innerHTML;
        let reg = tableRow.childNodes[5].innerHTML;
        let status = tableRow.childNodes[3].innerHTML;
        let id = tableRow.childNodes[1].innerHTML;
        let obj = {
          'neve': neve,
          'email': email,
          'ip': ip,
          'reg': reg,
          'status': status,
          'id': id
        };
        console.log(obj);
        id_atad2(obj.id);

        document.getElementById("neve1").value = obj.neve;
        document.getElementById("email1").value = obj.email;
        document.getElementById("ip1").value = obj.ip;
        document.getElementById("reg1").value = obj.reg;
        document.getElementById("status1").value = obj.status;
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