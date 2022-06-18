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
        $res = getCountries($_GET["searchTerm"]);
    }
    else{$res = getCountries();}
        
    $countries = [];
    while($country = mysqli_fetch_assoc($res)){
        $countries[] = $country;
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
    
</head>
<body>
<?php include "navbar.php"; ?>
    

<div class="container mt-4">
    <div class="row">
        <div class="col-8">
                <form action="countries.php" method="GET">
                    <input type="text" value="<?php echo $searchTerm ?>" name="searchTerm" placeholder="Pretraga" class="form-control my-3">
                </form>
            <table class="table table-hover">
                <thead>
                    <th>Naziv drzave</th>
                    <th>Izmijeni</th>
                    <th>Obrisi</th>
                </thead>
                <tbody>
                    <?php

                        foreach($countries as $country){
                            $country_name = $country['name'];
                            $country_id = $country['id'];
                            echo "<tr>
                                    <td>$country_name</td>
                                    <td><a href='editCountry.php?id=$country_id'><i class=\"fa-solid fa-pen\"></i></a></td>
                                    <td><i class=\"fa-solid fa-trash\" onclick=\"getCountryId($country_id)\" data-bs-toggle=\"modal\" data-bs-target=\"#countryModal\"></i></td>
                                  </tr>";
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>

        <div class="col-4">
          <a class="btn btn-primary float-start ms-5" href="addCountry.php">Dodaj drzavu</a>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="countryModal" tabindex="-1" aria-labelledby="countryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="countryModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Da li zaista zelite da obrisete ovu drzavu?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Izadji</button>
        <button type="button" class="btn btn-primary" onclick= "deleteCountry()">Da</button>
      </div>
    </div>
  </div>
</div>

<script src="app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
>
</body>
</html>