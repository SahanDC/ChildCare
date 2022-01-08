<?php include('config/db.php');
if (!isset($_SESSION['login'])) {
    header("Location: ./login.php");
}
if ($_SESSION['role'] == 'manager') {
    header("Location: ./manager.php");
}
if ($_SESSION['role'] == 'midwife') {
    header("Location: ./midwife.php");
} ?>

<?php
include('config/db.php');
$requestObj = new Advice($connection);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="css/patientmanager_styles.css" rel="stylesheet">

    <title>Child care</title>


</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light mb-4 bg-light">
        <!-- style="background-color: #e3f2fd" -->
        <div class="container">
            <a class="navbar-brand" href="./dashboard.php">Child Care</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-right" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li> -->
                    <li class="nav-item px-3">
                        <a class="nav-link" aria-current="page" href="./dashboard.php">Home</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link active" href="./advice.php">Medical Advices</a>
                    </li>
                    <!-- <li class="nav-item px-3">
                        <a class="nav-link" href="./controllers/logout.php">Log out</a>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-user-circle p-1"></i><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"] ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- <li><a class="dropdown-item" href="#">Account</a></li> -->
                            <!-- <li><a class="dropdown-item" href="#">Another action</a></li> -->
                            <!-- <li>
                                <hr class="dropdown-divider">
                            </li> -->
                            <li><a class="dropdown-item" href="./controllers/logout.php">Log out</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>
    <div class="container-xxl px-5">

        <!-- <h4>Advices</h4> -->
        <h5 class="row justify-content-center mt-5 mb-3">Medical Advices</h5>
        <p>Is the advice from your child’s doctor falling on deaf ears?<br> <strong>Sure you disagree with your
             pediatrician sometimes,
             but mostly you’re on the same page – at least in the doctor’s office.
              You don’t take your child’s health lightly. What parent does? Still,
               just as adults may be loath to follow their own physicians’ advice
                from time to time, parents – frustratingly for pediatricians who see
                 their children – frequently do the same. Experts say the reasons 
                 – like difficulty implementing recommendations at home – vary, as do the 
                 consequences: from exposure to certain health issues that might not seem
                  so dire to potentially putting a child’s life at risk.</strong>.</p>
        <?php
            $requests = $requestObj->get_advices();
            foreach ($requests as $request) { 
                echo $request['topic'];
            }
            echo $requests;
        ?>
        <?php

        $advice_set = "SELECT * FROM advice WHERE isdeleted=0";
        $result_advices = mysqli_query($connection, $advice_set);
        if ($result_advices) {
            #echo mysqli_num_rows($result_advices);
            #$records=mysqli_fetch_assoc($result_advices);

            while ($records = mysqli_fetch_assoc($result_advices)) {
        ?>
                <div class="row mb-3">
                    <div class="col-md-4 themed-grid-col"><?php echo $records['topic']; ?></div>
                    <div class="col-md-8 themed-grid-col">
                        <p><?php echo $records['content'];
                            ?></p>
                        <!-- <div class="container">
                    
                    <button type="button" class="btn btn-secondary"><a href="delete advices.php?id=<?php echo $records['id']; ?>">DELETE</a> </button>
                    <button type="button" class="btn btn-secondary"><a href="update record.php?id=<?php echo $records['id']; ?>">EDIT</a> </button>
                </div> -->
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>