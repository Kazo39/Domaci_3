<?php

    session_start();
    include('db_functions.php');


    
    $username = $_POST['username'];
    $pass = $_POST['password'];

    if($user = findUserByUsernameAndPassword($username,$pass)){
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = $user;

        header("location:index.php?msg=Welcome");
        exit;
    }

    header("location:login.php?msg=wrongCredentials");
        exit;

    
?>