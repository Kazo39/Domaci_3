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

    $city_name = $_POST['city_name'];
    if(isset($_POST['country_id'])){
        $country_id = $_POST['country_id'];
    }else{
        header("location: addCity.php?msg=WrongCountryChoice");
        exit;
    }

    saveCityInDB($city_name,$country_id);
    header("location: cities.php");

?>