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
    $searchTerm = "";
    if(isset($_GET["searchTerm"]) && $_GET["searchTerm"] != ""){
        $searchTerm = $_GET["searchTerm"];
        $contacts = getContactsFromDataBase($_GET["searchTerm"]);
    }
    else{
        $contacts = getContactsFromDataBase();
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"  />
    <title>Phonebook</title>
</head>
<body>

<?php include "navbar.php"; ?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-8">
                <form action="index.php" method="GET">
                    <input type="text" value="<?php echo $searchTerm ?>" name="searchTerm" placeholder="Pretraga" class="form-control my-3">
                </form>
            <table id="contactsList" class="table table-hover">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Email</th>
                        <th>Drzava</th>
                        <th>Grad</th>
                        <th>Izmjena</th>
                        <th>Brisanje</th>
                    </tr>
                </thead>
                <?php
                
                foreach($contacts as $contact){
                    $first_name = $contact['first_name'];
                    $last_name = $contact['last_name'];
                    $email = $contact['email'];
                    $city = $contact['city'];
                    $country = $contact['country'];
                    $id = $contact['id'];

                    echo "<tr>
                            <td>$first_name</td>
                            <td>$last_name</td>
                            <td>$email</td>
                            <td>$country</td>
                            <td>$city</td>
                            <td>
                                <a href='edit.php?id=$id'><i class=\"fa-solid fa-pen\"></i></a>
                            </td>
                            <td>
                                <a href='deleteContact.php?id=$id'><i class=\"fa-solid fa-trash\"></i></a>
                            </td>
                          </tr>";
                }
                ?>

            </table>
            </div>
            <div class="col-4">
                <h3>Dodavanje novog kontakta</h3>
                <form action="saveContact.php" method="POST">

                    <input type="text" required class="form-control mt-3" name="first_name" placeholder="Unesite ime...">
                    <input type="text" required class="form-control mt-3" name="last_name" placeholder="Unesite prezime...">
                    <input type="email" required class="form-control mt-3" name="email" placeholder="Unesite email...">

                    <select name="country_id" id="country_id" class="form-control mt-3" onchange="displayCities()">
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

                    <select name="city_id" id="city_id" class="form-control mt-3" >
                    </select>
                    <button class="btn btn-primary mt-3 float-end">Dodaj kontakt</button>
                </form>
            </div>
        </div>
    </div>


    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>