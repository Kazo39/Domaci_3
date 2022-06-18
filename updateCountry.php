<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }   


    include('db_functions.php');
    include('connect_db.php');

    $id = $_POST['country_id'];
    $country_name = $_POST['country_name'];

    updateCountryInDB($id,$country_name);
    header("location: countries.php");
    exit;
?>