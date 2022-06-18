<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include "connect_db.php";


    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }
    include('db_functions.php');

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $city_id = $_POST['city_id'];

    updateContactInDb($first_name,$last_name,$email,$id,$city_id);

    header('location:index.php');
    exit;
?>