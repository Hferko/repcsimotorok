<!-- Start Footer -->
<footer class="bg-dark" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h3 class="h3 text-success border-bottom pb-3 border-light logo">Repcsimotorok Shop</h4>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="contact.php">
                                <h3>
                                    KAPCSOLAT </h4>
                            </a></li>
                        <li class="nav-item dropdown" style="text-indent:-15px;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Bejelentkezés
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink" style="background-color: mediumblue;padding-left:4px;">
                                <li><a class="dropdown-item bg-transparent" href="login/login.php">Login</a></li>
                                <li><a class="dropdown-item bg-transparent" href="login/regisztral.php">Regisztráció</a></li>
                                <li><a class="dropdown-item bg-transparent" href="login/admin_login.php">Admin</a></li>
                            </ul>
                        </li>

                    </ul>
                    <a class="navbar-brand text-success logo h2 align-self-center" href="https://www.mtu.de/" target="_blank">
                        <img src="assets/img/mtu_logo_light.svg" alt="MTU">
                    </a>

            </div>

            <div class="col-md-4 pt-5">
                <h3 class="h3 text-light border-bottom pb-3 border-light">Termékek</h3>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="shop_com.php">Kereskedelmi repülőgép-hajtóművek</a></li>
                    <li><a class="text-decoration-none" href="shop_military.php">Katonai repülőgép-hajtóművek</a></li>
                    <li><a class="text-decoration-none" href="shop_indust.php">Ipari gázturbinák</a></li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h3 class="h3 text-light border-bottom pb-3 border-light">További információ</h3>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="https://aeroreport.de/en/good-to-know/how-does-a-turbofan-engine-work" target="_blank">how-does-a-turbofan-engine-work</a></li>
                    <li><a class="text-decoration-none" href="https://www.mtu.de/engines/" target="_blank">https://www.mtu.de/engines/</a></li>
                    <li><a class="text-decoration-none" href="https://executiveflyers.com/how-much-does-a-jet-engine-cost/" target="_blank">how-much-does-a-jet-engine-cost</a></li>

                </ul>
            </div>

        </div>
        <!--<p class="text-center text-warning"><a href="https://www.mtu.de/" target="_blank">© 2022 MTU Aero Engines AG.</a>-->
        </p>
        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.facebook.com/hangai.ferko"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://github.com/Hferko"><i class="fab fa-github fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://youtu.be/7v-lyKce7U8"><i class="fab fa-youtube fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/in/ferko-hangai-01a14820a"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>

            <div class="col-auto text">
                <p><a class="fs-5 fw-bold" href="./assets/gdpr.html">ADATVÉDELMI SZABÁLYZAT </a></p>
                <p><a class="fs-5 fw-bold" href="./assets/aszf.rtf" target="_blank">Általános Szerződési Feltételek (ÁSZF)</a></p>
            </div>
        </div>
    </div>

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-center text-light fs-5">
                        <?php
                        if (isset($_SESSION["nev"])) {
                            echo 'Belépett felhasználó: &nbsp;<b>' . $_SESSION['nev'] . '</b> &nbsp; ';
                        }
                        if (isset($_SESSION["admin"])) {
                            echo 'Belépett felhasználó: &nbsp;<b>' . $_SESSION['admin'] . '</b>';
                        }
                        ?>
                    </p>
                    <p class="text-center text-warning fs-6">
                        Az adatok, képek a <a href="https://www.mtu.de/" target="_blank"> &copy; 2022 MTU Aero
                            Engines AG tulajdonát képezik.</a> <br>
                        Azok, csupán tanulási szándékkal kerültek alkalmazásra. <br>
                        Így egyéb felhasználásuk sem publikus, sem kereskedelmi okból nem lehetséges!

                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- End Footer -->