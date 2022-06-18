<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include "connect_db.php";


    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }
    include("db_functions.php");

    $country_name = $_POST['country_name'];
    

    saveCountryInDB($country_name);
    header("location: countries.php");

?>