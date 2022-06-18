<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include "connect_db.php";


    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }
    include "connect_db.php";
    include "db_functions.php";

    if(isset($_GET['country_id'])){
        $city_id = $_GET['country_id'];
    }else{
        echo json_encode([]);
        exit;
    }
    
    if(deleteCountryInDB($city_id)){
        echo json_encode([]);
        exit;
    }

    if(!deleteCityInDB($city_id)){
        $res = ["status" => "fail"];
        echo json_encode($res);
        exit;
    };
    
   
    

?>