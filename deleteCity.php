<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }
    include "connect_db.php";
    include "db_functions.php";

    if(isset($_GET['city_id'])){
        $city_id = $_GET['city_id'];
    }else{
        echo json_encode([]);
        exit;
    }
    
    if(deleteCityInDB($city_id)){
        echo json_encode([]);
        exit;
    }

    if(!deleteCityInDB($city_id)){
        $res = ["status" => "fail"];
        echo json_encode($res);
        exit;
    };
    
   
    

?>