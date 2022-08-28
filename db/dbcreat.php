<?php

$conn;
$flag = false;

function nyit()
{
    require('./config.php');
    global $conn;
    global $flag;
    mysqli_report(MYSQLI_REPORT_OFF);
    $connect = @mysqli_connect($servername, $username, $password);
    if (!$connect) {
        $flag = false;
        echo '<p>Kérlek ellenőrizd a kapcsolódási adatokat</p>';
        die("KAPCSOLÓDÁS SIKERTELEN: " . mysqli_connect_error());        
    }

    echo '<h4>Sikeres a kapcsolat !</h4>';
    $flag = true;
    $conn = $connect;
    return $connect;
}

function createdb()
{
    require('./config.php');
    global $conn;
    global $flag;
    $dbneve = $dbname;
    //echo $dbneve;    
    $adatbazis = "CREATE DATABASE IF NOT EXISTS `$dbneve` CHARACTER SET utf8 COLLATE utf8_general_ci";

    if ((mysqli_query($conn, $adatbazis))) {
        if (mysqli_warning_count($conn) == 0) {
            echo '<h4>Sikeresen létrehozva a ' . $dbneve . ' adatbázis</h4>';
            $flag = true;
        } else {
            echo '<h4>"' . $dbneve . '" nevű adatbázis már létezik.</h4>';
            $flag = true;
        }
    } else {
        echo "Nem sikerült létrehozni az adatbázist" . mysqli_error($conn);
        $flag = false;
    }
}
//createdb();

function category_table()
{
    require('./config.php');
    global $conn;

    $db = $dbname;
    $kategoria = "CREATE TABLE IF NOT EXISTS `$db`.`category` (
                    `kat_id` INT(4) NOT NULL AUTO_INCREMENT ,  
                    `kat_nev1` VARCHAR(40) NOT NULL ,  
                    `kat_nev2` VARCHAR(40), 
                    PRIMARY KEY  (`kat_id`)                   
                    );";

    if (mysqli_query($conn,  $kategoria)) {
        echo '<h4>A "category" nevű tábla létrehozása sikeres.</h4>';
    } else {
        echo "Tábla létrehozása sikertelen: " . mysqli_error($conn) . '<hr>';
    }
}

function turbina_table()
{
    require('./config.php');
    global $conn;
    $db = $dbname;

    $turbina = "CREATE TABLE IF NOT EXISTS `$db`.`turbina` (
                `t_id` INT(4) NOT NULL AUTO_INCREMENT ,  
                `nev` VARCHAR(60) NOT NULL ,
                `kat` INT(4) NOT NULL , 
                `toloero` VARCHAR(30),
                `teljesit` VARCHAR(30),
                `bpr` VARCHAR(20),
                `nyomasarany` VARCHAR(20),
                `hossz` VARCHAR(20),
                `ventilator_atmero` VARCHAR(20),
                `suly` VARCHAR(20),
                `gep` TEXT(200),
                `extras` TEXT(400),
                `descript` TEXT(500),
                `felv_datum` DATE,
                `modositva` DATE,
                PRIMARY KEY  (`t_id`),
                INDEX (`kat`)                
                )CHARACTER SET utf8mb4;";

    if (mysqli_query($conn,  $turbina)) {
        echo '<h4>A "turbina" nevű tábla létrehozása sikeres.</h4>';
    } else {
        echo "Tábla létrehozása sikertelen: " . mysqli_error($conn) . '<hr>';
    }
}

function images_table()
{
    require('./config.php');
    global $conn;

    $db = $dbname;

    $kepek = "CREATE TABLE IF NOT EXISTS `$db`.`images` (
                    `kep_id` INT(4) NOT NULL AUTO_INCREMENT ,  
                    `t_id` INT(4),
                    `path` VARCHAR(60),  
                    `alt` VARCHAR(40),  
                    `alap` INT(1),
                    PRIMARY KEY  (`kep_id`),
                    INDEX (`t_id`),
                    FOREIGN KEY (t_id) REFERENCES turbina(t_id)
                    );";

    if (mysqli_query($conn,  $kepek)) {
        echo '<h4>Az "images" nevű tábla létrehozása sikeres.</h4>';
    } else {
        echo "Tábla létrehozása sikertelen: " . mysqli_error($conn) . '<hr>';
    }
}

function arak_table()
{
    require('./config.php');
    global $conn;

    $db = $dbname;

    $arak = "CREATE TABLE IF NOT EXISTS `$db`.`arak` (
                    `ar_id` INT(4) NOT NULL AUTO_INCREMENT ,  
                    `t_id` INT(4) NOT NULL ,
                    `ar` FLOAT(14) NOT NULL ,  
                    `tol` DATE,
                    `ig` DATE,
                    PRIMARY KEY  (`ar_id`),
                    INDEX (`t_id`),                    
                    FOREIGN KEY (t_id) REFERENCES turbina(t_id)
                    );";

    if (mysqli_query($conn,  $arak)) {
        echo '<h4>Az "arak" nevű tábla létrehozása sikeres.</h4>';
    } else {
        echo "Tábla létrehozása sikertelen: " . mysqli_error($conn) . '<hr>';
    }
}
//price_table();

function felhasznalo_table()
{
    require('./config.php');
    global $conn;

    $db = $dbname;

    $felhasznalo = "CREATE TABLE IF NOT EXISTS `$db`.`felhasznalo` (
                    `felhasznalo_id` INT(4) NOT NULL AUTO_INCREMENT ,  
                    `neve` VARCHAR(40) NOT NULL ,
                    `jelszo` VARCHAR(100) NOT NULL ,
                    `vez_nev` VARCHAR(40),
                    `ker_nev` VARCHAR(40),
                    `telefon` VARCHAR(20),
                    `email` VARCHAR(40) NOT NULL,
                    `ir_szam` INT(6),
                    `varos` VARCHAR(60),
                    `cim` VARCHAR(90) ,      
                    `ip_cim` VARCHAR(40) NOT NULL ,
                    `reg_datum` DATE,    
                    `latest` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    `status` VARCHAR(20),
                    PRIMARY KEY  (`felhasznalo_id`),
                    INDEX (`email`)    
                    )CHARACTER SET utf8mb4;";

    if (mysqli_query($conn,  $felhasznalo)) {
        echo '<h4>A "felhasznalo" nevű tábla létrehozása sikeres.</h4>';
    } else {
        echo "Tábla létrehozása sikertelen: " . mysqli_error($conn) . '<hr>';
    }
}


function vevo_table()
{
    require('./config.php');
    global $conn;

    $db = $dbname;

    $vevo = "CREATE TABLE IF NOT EXISTS `$db`.`vevo` (
                `vevo_id` INT(5) NOT NULL AUTO_INCREMENT,               
                `vez_nev` VARCHAR(40) NOT NULL,
                `ker_nev` VARCHAR(40) NOT NULL,
                `telefon` VARCHAR(20),
                `email` VARCHAR(40) NOT NULL,
                `ir_szam` INT(6) NOT NULL,
                `varos` VARCHAR(60) NOT NULL,
                `cim` VARCHAR(90) NOT NULL,               
                PRIMARY KEY (`vevo_id`),
                INDEX (`email`)                             
                )CHARACTER SET utf8mb4;";

    if (mysqli_query($conn,  $vevo)) {
        echo '<h4>A "vevo" nevű tábla létrehozása sikeres.</h4>';
    } else {
        echo "'vevo' tábla létrehozása sikertelen: " . mysqli_error($conn) . '<hr>';
    }
}

function szamla_table()
{
    require('./config.php');
    global $conn;

    $db = $dbname;

    $szamla = "CREATE TABLE IF NOT EXISTS `$db`.`szamla` (
                `tetel` INT(5) NOT NULL AUTO_INCREMENT,
                `szamlaszam` INT(6) NOT NULL DEFAULT 100,                
                `email` VARCHAR(40) NOT NULL,                
                `comment` TEXT(200),
                `t_id` INT(4) NOT NULL,
                `tipus` VARCHAR(40) NOT NULL,
                `egyseg_ar` FLOAT(14) NOT NULL,  
                `mennyiseg` INT (3) NOT NULL,
                `ossz_ar` FLOAT(14) NOT NULL, 
                `kezbesit` VARCHAR(20),
                `fizet_mod` VARCHAR(20),
                `teljes_osszeg` FLOAT(16),
                `created` DATE NOT NULL,
                `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`tetel`),
                INDEX (`email`),                    
                FOREIGN KEY (`email`) REFERENCES `felhasznalo`(`email`)                         
                )CHARACTER SET utf8mb4;";

    if (mysqli_query($conn,  $szamla)) {
        echo '<h4>A "szamla" nevű tábla létrehozása sikeres.</h4>';
    } else {
        echo "'szamla' tábla létrehozása sikertelen: " . mysqli_error($conn) . '<hr>';
    }

}

