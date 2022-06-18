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

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title></title>
</head>
<body>
    <div class="container mt-5">
        <div class="row"><div class="col-8 offset-2">
                <h3>Dodavanje nove drzave</h3>
                <form action="saveCountry.php" method="POST">

                    <input type="text" required class="form-control mt-3" name="country_name" placeholder="Unesite naziv...">


                    <button class="btn btn-primary mt-3 float-end">Dodaj drzavu</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>