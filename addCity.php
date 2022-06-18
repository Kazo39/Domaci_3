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
                <h3>Dodavanje novog grada</h3>
                <form action="saveCity.php" method="POST">

                    <input type="text" required class="form-control mt-3" name="city_name" placeholder="Unesite naziv...">

                    <select name="country_id" id="country_id" class="form-control mt-3">
                        <option disabled selected>-- Odaberite drzavu -- </option>
                        <?php
                        
                            $countries = getCountries();

                            while($country = mysqli_fetch_assoc($countries)){
                                $country_id = $country['id'];
                                $country_name = $country['name'];
                                echo "<option value =\"$country_id\">$country_name</option>";
                            }
                        ?>
                    </select>

                    <button class="btn btn-primary mt-3 float-end">Dodaj grad</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>