
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
        $city = findCityById($id);
       
    }else{
        header('location:cities.php');
    }



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-8 offset-2">
                <h2>Izmjena naziva grada</h3>
                    <form action="updateCity.php" method="POST" class="mt-5">
                        <select name="country_id" id="country_id" class="form-control mt-3" onchange="displayCities()" >
                            <option disabled selected>-- Odaberite drzavu -- </option>
                            <?php
                        
                                $countries = getCountries();

                                while($country = mysqli_fetch_assoc($countries)){
                                    $country_id = $country['id'];
                                    $country_name = $country['name'];
                                    $selected = '';
                                    if($country_id == $city['country_id']){
                                    $selected = "selected";
                                    }
                                    echo "<option value =\"$country_id\" $selected>$country_name</option>";
                                }
                            ?>
                        </select>
                        <input type="text" class="form-control mt-3" name = "city_name" value = "<?= $city['name']?>">
                        <input type="hidden" name="city_id" value="<?=$city['id']?>">

                        <button class="btn btn-primary mt-3 float-end">Izmijeni</button>
                    </form>
            </div>
        </div>
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>