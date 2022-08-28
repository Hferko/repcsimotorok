<?php
function uzenet($message)
{
    echo "<script>alert('$message');</script>";
}

function mgbox()
{
    //session_start();
    if (isset($_SESSION['rendben'])) {
        $uzenet = uzenet($_SESSION['rendben']);
        return $uzenet;
    }

    if (isset($_SESSION['fail'])) {
        $uzenet = uzenet($_SESSION['fail']);
        return $uzenet;
    }

    if (isset($_SESSION['hiba'])) {
        $uzenet = uzenet($_SESSION['hiba']);
        return $uzenet;
    }
}
