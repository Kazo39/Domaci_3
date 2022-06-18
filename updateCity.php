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

    $id = $_POST['city_id'];
    $city_name = $_POST['city_name'];
    $country_id = $_POST['country_id'];

    updateCityInDB($id,$city_name,$country_id);
    header("location: cities.php");
    exit;
?>