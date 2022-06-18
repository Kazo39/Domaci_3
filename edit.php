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
        $contact = findContactByIdInDb($id);
    }else{
        header('location:index.php');
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Phonebook</title>
</head>
<body>
  
    <div class="container mt-5">
        <div class="row">
            <div class="col-8 offset-2">
                <h3>Izmjena detalja kontakta</h3>
                <form action="updateContact.php" method="POST">
                    <input type="hidden" name="id" value="<?=$contact['id']?>">
                    <input type="text" required class="form-control mt-3" name="first_name" value = "<?=$contact['first_name']?>">
                    <input type="text" required class="form-control mt-3" name="last_name"  value = "<?=$contact['last_name']?>">
                    <input type="email" required class="form-control mt-3" name="email"  value = "<?=$contact['email']?>">
                    <select name="country_id" id="country_id" class="form-control mt-3" onchange="displayCities()">
                        <option disabled selected>-- Odaberite drzavu -- </option>
                        <?php
                        
                            $countries = getCountries();

                            while($country = mysqli_fetch_assoc($countries)){
                                $country_id = $country['id'];
                                $country_name = $country['name'];
                                $selected = '';
                                if($country_id == $contact['country_id']){
                                    $selected = "selected";
                                }
                                echo "<option value =\"$country_id\" $selected>$country_name</option>";
                            }
                        ?>
                    </select>

                    <select name="city_id" id="city_id" class="form-control mt-3" >
                        <?php
                            $cities = getCitiesByCountryFromDb($contact['country_id']);

                            while($city = mysqli_fetch_assoc($cities)){
                                $city_id = $city['id'];
                                $city_name = $city['name'];
                                $selected = '';
                                if($city_id == $contact['city_id']){
                                    $selected = "selected";
                                }
                                echo "<option value =\"$city_id\" $selected>$city_name</option>";
                            }
                        ?>
                    </select>

                    <button class="btn btn-primary mt-3 float-end">Izmijeni kontakt</button>
                </form>
            </div>
        </div>
    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>