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

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        header('location:index.php');
    }

    deleteContactFromDB($id);
    header('location:index.php');

?>