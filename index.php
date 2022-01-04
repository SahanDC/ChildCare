<?php
include('config/db.php');

if (isset($_SESSION['login'])) {
    header("Location: ./dashboard.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Child Care</title>
</head>

<body background="img/doctor.jpg" style="background-size: cover;">
<header>
<!-- <div class="px-3 py-2 bg-dark text-white">

</div> -->
<span class="d-block p-4 bg-info text-white" style="background-color:#13f2fd">
 </span>
</header>
    <nav class="navbar navbar-expand-lg navbar-light mb-4" style="background-color: #13f2fd">
        <div class="container">
            <a class="navbar-brand" href="./index.php">Child Care</a>
            <br>
            <br>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-right" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Sign up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="background-image: img/24093.jpg">
        <div class="card text-white bg-info mb-3" style="max-width: 40rem; opacity:.5; height:100%">
            <div class="card-header">Welcome to child care</div>
            <div class="card-body">
                <br>
                <br>
                <br>
                <p>Create an account <a href="signup.php">Sign up</a> </p>
                <p>Already have an account? <a href="login.php">Log in</a></p>
            </div>
        </div>

        <h3></h3>
        <br>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>