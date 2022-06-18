<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include "connect_db.php";


    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }
    include "db_functions.php";

    if(isset($_GET['country_id'])){
        $country_id = $_GET['country_id'];
    }else{
        echo json_encode([]);
        exit;
    }

    $cities = getCitiesByCountryFromDb($country_id);

    $result = [];
    while($city = mysqli_fetch_assoc($cities)){
        $result[] = $city;
    }

    echo json_encode($result);
?>