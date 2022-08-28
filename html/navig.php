<!--Felső navigáció-->
<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
    <div class="container text-light">
        <div class="w-100 d-flex justify-content-between">
            <div>
                <i class="fa fa-envelope mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="contact.php">repcsimotorok@acme.com</a>
                <i class="fa fa-phone mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="contact.php">+36 30 444 55 66</a>
            </div>
            <?php
            if (isset($_SESSION["nev"])) {
                echo '<div><b>Belépett felhasználó: &nbsp;</b><strong>' . $_SESSION['nev'] . '</strong></div>';
            }
            if (isset($_SESSION["admin"])) {
                echo '<div>Belépett felhasználó: &nbsp;<b>' . $_SESSION['admin'] . '</b></div>';
            }
            ?>
            <div>
                <a class="text-light" href="https://www.facebook.com/hangai.ferko" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                <a class="text-light" href="https://github.com/Hferko" target="_blank"><i class="fab fa-github fa-sm fa-fw me-2"></i></a>
                <a class="text-light" href="https://youtu.be/7v-lyKce7U8" target="_blank"><i class="fab fa-youtube fa-sm fa-fw me-2"></i></a>
                <a class="text-light" href="https://www.linkedin.com/in/ferko-hangai-01a14820a" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
            </div>
        </div>
    </div>
</nav>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex flex-row justify-content-between align-items-center">
        <a class="navbar-brand text-success logo h2 align-self-center" href="kezdolap.php">
            <img src="assets/img/pngegg.png" alt="Repcsimotorok">
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="kezdolap.php">Kezdőlap</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Bejelentkezés
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="login/login.php">Login</a></li>
                            <li style="border-bottom:1px solid #bbb ;"><a class="dropdown-item" href="login/regisztral.php">Regisztráció</a></li>
                            <li style="background-color: beige;"><a class="dropdown-item" href="login/admin_login.php">Admin</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login/logout.php">
                            Kilépés
                            <i class="fa fa-sign-out-alt fa-fw"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <a class="nav-icon d-none d-lg-inline" href="kosar.php">
                    Kosár:
                </a>
                <a class="nav-icon position-relative text-decoration-none" href="kosar.php">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    <?php
                    if (!empty($_SESSION["kosar_tartalma"])) {
                        $kosar_count = count($_SESSION["kosar_tartalma"]);                       
                    ?>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill  text-dark" style="background-color: #ffb3b3;">
                            <?php echo $kosar_count; ?>
                        </span>
                    <?php
                    }
                    ?>
                </a>
            </div>
        </div>
    </div>
</nav>