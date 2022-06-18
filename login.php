
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Phonebook -</title>
</head>
<body>
  
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h3 class="text-center">Prijava</h3>
                <form action="tryLogin.php" method="POST">

                    <input type="text" required class="form-control mt-3" name="username" placeholder="Korisnicko ime...">
                    <input type="password" required class="form-control mt-3" name="password" placeholder="Sifra...">
                   

                    <button class="btn btn-primary mt-3 float-end">Prijavi me</button>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>