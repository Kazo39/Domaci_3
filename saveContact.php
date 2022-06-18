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

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $user_id = $_SESSION['user']['id'];
    $city_id = $_POST['city_id'];
    

    saveContactToDataBase($first_name,$last_name,$email,$user_id,$city_id);

    header("location: ./index.php");
?>