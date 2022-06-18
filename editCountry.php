
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
    $country = findCountryById($id);
   
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
                <form action="updateCountry.php" method="POST" class="mt-5">
                    
                    <input type="text" class="form-control mt-3" name = "country_name" value = "<?= $country['name']?>">
                    <input type="hidden" name="country_id" value="<?=$country['id']?>">

                    <button class="btn btn-primary mt-3 float-end">Izmijeni</button>
                </form>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>