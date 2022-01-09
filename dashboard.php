<?php include('config/db.php');
include('controllers/upload.php');
require_once('models/request.php');
require_once('models/user_parent.php');

if (!isset($_SESSION['login'])) {
    header("Location: ./login.php");
}
if ($_SESSION['role'] == 'manager') {
    header("Location: ./manager.php");
}
if ($_SESSION['role'] == 'midwife') {
    header("Location: ./midwife.php");
}

$parentObj = new User_Parent($connection, $_SESSION['email']);

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/dashboardStyle.css">
    <!-- <link href="css/patientmanager_styles.css" rel="stylesheet"> -->

    <title>Child care</title>
    <script>
        function enable_cc() {
            var checkBox = document.getElementById("flexCheckDefault");
            var ccUpload = document.getElementById("formFileDisabled");

            if (checkBox.checked == true) {
                ccUpload.disabled = false;
            } else {
                ccUpload.disabled = true;
            }
        }

        function enable_upload() {
            var icon = document.getElementById("icon");
            var form = document.getElementById("upload_form");
            if (form.classList.contains("d-none")) {
                form.classList.remove("d-none");
                icon.classList.remove("fa-chevron-circle-down");
                icon.classList.add("fa-chevron-circle-up");
            } else {
                form.classList.add("d-none");
                icon.classList.remove("fa-chevron-circle-up");
                icon.classList.add("fa-chevron-circle-down");
            }
        }
    </script>
</head>

<body>
    <!-- header section starts  -->
    <!-- <header style="background-color: rgb(181, 239, 241);">
        <div class="container" style="background-color: rgb(181, 239, 241);">
            <h1>Hello <?php //echo $_SESSION["firstname"] . " " . $_SESSION["lastname"] 
                        ?></h1>
            <nav class="nav">
                <ul>
                    <li><a href="login.php">Home</a></li>
                    <li><a href="parents health advices.php">See Medical Advice</a></li>
                    <li><a href="./controllers/logout.php">log Out</a></li>
                </ul>
            </nav>
            <div class="fas fa-bars"></div>
        </div>
    </header> -->
    <!-- header section ends  -->

    <nav class=" navbar sticky-top navbar-expand-sm navbar-light mb-4 bg-light">
        <div class="container">
            <a class="navbar-brand" href="./dashboard.php">Child Care Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-right" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item px-3">
                        <a class="nav-link active" aria-current="page" href="./dashboard.php">Home</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link" href="./advice.php">Medical Advices</a>
                    </li>
                    <!-- <li class="nav-item px-3">
                        <a class="nav-link" href="./controllers/logout.php">Log out</a>
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
                    <!-- <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li> -->
                </ul>
                <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>
    <!-- <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #e3f2fd">
        <div class="container-fluid">
            <a class="navbar-brand" href="./dashboard.php">Child Care</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="dropdown" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./controllers/logout.php">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->

    <div class="container-xxl px-5">



        <div class="row">


            <div class="col-xl-6 col-lg-6 order-2 order-lg-2 px-4">
                <div class="container-xl mt-3 mb-3">
                    <!-- {$_SESSION["id"]} -->
                    <?php $requests = $parentObj->getRequestsByParent($_SESSION["id"]);
                    $count = 0; ?>
                    <h5 class="row justify-content-center mb-3">Child Report Requests</h5>
                    <div class="accordion accordion-flush" id="accordionFlushExample">

                        <?php foreach ($requests as $request) { ?>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading<?= $count ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?= $count ?>" aria-expanded="false" aria-controls="flush-collapseOne<?= $count ?>">
                                        <?php $query = $connection->query("SELECT * FROM request where id = '{$request['id']}'");
                                        // $request = $requestObj->getRequestById($requestx['id']);
                                        $requestID = $request['id'];
                                        // $row = $query->fetch_assoc();

                                        $parent_id = $request["parent_id"];
                                        $query_parent = $connection->query("SELECT * FROM user where id = '{$parent_id}'");
                                        ?>
                                        <div class="col-2">

                                            ID:
                                            <?php
                                            echo $request["id"]; ?>
                                        </div>
                                        <!-- <div class="col-4">

                            Parent:
                            <?php
                            while ($parent = mysqli_fetch_array($query_parent)) {
                                echo $parent["firstname"] . " " . $parent["lastname"] . "\n";
                            } ?>
                        </div> -->

                                        <div class="col-7">

                                            Uploaded on:
                                            <?php
                                            echo $request["uploaded_on"]; ?>
                                        </div>
                                        <div class="col-3">

                                            Status:
                                            <?php
                                            echo $request["status"]; ?>
                                        </div>

                                    </button>
                                </h2>
                                <!-- <?php (isset($_POST['valid']) && $_POST['reqId'] == $requestID) ? 'collapse.show' : '' ?>  -->
                                <div id="flush-collapseOne<?= $count ?>" class="accordion-collapse collapse " aria-labelledby="flush-headingOne<?= $count ?>" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="container-xl row justify-content-center bg-light">


                                            <?php
                                            // $query = $connection->query("SELECT * FROM request where id = '{$request['id']}'");
                                            $requestID = $request['id'];
                                            $request = $query->fetch_assoc();

                                            $file1 = './requests/' . $request["birth_certificate"];
                                            $parent_id = $request["parent_id"];
                                            $query_parent = $connection->query("SELECT * FROM user where id = '{$parent_id}'");
                                            ?>

                                            <!-- <h4 class="mt-4">Birth certificate</h4> -->
                                            <!-- <iframe src="<?php echo $file1; ?>" width="90%" height="500px">
                            </iframe> -->
                                            <div class="row justify-content-evenly p-2">
                                                <div class="col-6 p-0">

                                                    <a style="text-decoration: none;" href="<?php echo $file1; ?>" target="_blank"><i class="fas fa-file p-1"></i> Birth Certificate</a>
                                                </div>
                                                <div class="col-6 p-0">

                                                    <?php
                                                    if ($request["clinic_card"] == NULL) { ?>
                                                        <p> No child report. </p>
                                                    <?php
                                                    } else {
                                                        $file2 = './requests/' . $request["clinic_card"];

                                                    ?>
                                                        <!-- <iframe src="<?php echo $file2; ?>" width="90%" height="500px"></iframe> -->
                                                        <a style="text-decoration: none;" href="<?php echo $file2; ?>" target="_blank"><i class="fas fa-file p-1"></i> Clinic Card</a>


                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php $count++;
                        } ?>
                    </div>
                    <?php if ($count == 0) { ?>
                        <div class="row justify-content-center">

                            No child report requests yet.
                        </div>
                    <?php } ?>
                </div>
                <div class="container p-3 mb-3 mt-3">
                    <!-- <h6><?php echo $_SESSION['firstname']; ?>
<?php echo $_SESSION['lastname']; ?></h6> -->

                    <div class="row mx-auto w-75">

                        <button class="btn btn-outline-success" onclick="enable_upload()">Open New Child Report <i id="icon" class="fas fa-chevron-circle-down px-2"></i></button>
                    </div>
                    <!-- <a class="btn btn-light" href="">Child Reports</a> -->


                    <?php echo $response; ?>
                    <!-- <h4>Open a Child Report</h4> -->

                    <div class="container d-none bg-light py-2 mb-5 mt-3" id="upload_form">
                        <p>1. Upload a pdf copy of your child's birth certificate.</p>
                        <p>2. Upload a pdf copy of your child's clinic card (if your child has one). </p>
                        <div class="container col justify-content-center border mt-5 m-3 p-3 rounded">

                            <form action="" method="post" enctype="multipart/form-data">

                                <!-- <label for="file">Birth certificate:</label>
<input class="form-control-file mb-2" type="file" name="file" id="file"> -->
                                <div class="mb-4">
                                    <label for="formFile" class="form-label">1. Birth certificate:</label>
                                    <input class="form-control" type="file" name="file1" id="file1">
                                </div>
                                <!-- <label for="file">Clinic card (if exist):</label>
<input class="form-control-file mb-2 disabled" type="file" name="file2" id="file2"> -->
                                <div class="mb-4">
                                    <label for="formFileDisabled" class="form-label">2. Clinic card:</label>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="clinic_card" value="Yes" id="flexCheckDefault" onclick="enable_cc()">
                                        <label class=" form-check-label" for="flexCheckDefault">
                                            Select if your child has a clinic card
                                        </label>
                                    </div>
                                    <input class="form-control" type="file" id="formFileDisabled" name="file2" id="file2" disabled>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input class="btn btn-primary mt-2" type="submit" value="Upload">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-6 col-lg-6 order-1 order-lg-1 px-4 justify-content-center">
                <div class="row justify-content-left mt-3">
                    <?php $reports = $parentObj->getReportsByParent($_SESSION["id"]);
                    $count = 0
                    // child_reports = $connection->query("SELECT * FROM child_report WHERE GuardianId = '{$_SESSION["id"]}' ORDER BY Birthday ASC");
                    // if ($child_reports->num_rows > 0) { 
                    ?>
                    <h5 class="row justify-content-center mb-3">Child Reports</h5>
                    <?php
                    // while ($row = $child_reports->fetch_assoc()) {
                    foreach ($reports as $row) {
                        $count += 1; ?>
                        <div class="col-sm-12 col-md-6 col-lg-12 p-1">

                            <div class="card mb-3">
                                <!-- <h5 class="card-header bg-white text-dark d-flex justify-content-center p-2"><?php echo $row["Name"] ?></h5> -->
                                <div class="card-body bg-light">
                                    <!-- border border-1 border-light rounded-3 -->
                                    <!-- <h5 class="card-title row justify-content-center my-2 p-2"></h5> -->
                                    <?php if ($row['NVD'] != '') { ?>

                                        <?php if (0 > (strtotime($row['NVD']) - strtotime(date("Y-m-d", time()))) / 86400) { ?>
                                            <p class="alert-auto alert-danger text-center p-1 mb-0">Vaccination on <?php echo $row['NVD']; ?> missed</p>
                                        <?php } ?>
                                        <?php if (14 >= (strtotime($row['NVD']) - strtotime(date("Y-m-d", time()))) / 86400 && 0 <= (strtotime($row['NVD']) - strtotime(date("Y-m-d", time()))) / 86400) { ?>
                                            <p class="alert-auto alert-warning text-center p-1 mb-0"><?php echo (strtotime($row['NVD']) - strtotime(date("Y-m-d", time()))) / 86400;
                                                                                                        ?> days more for next vaccination</p>
                                        <?php } ?>
                                        <?php if (14 < (strtotime($row['NVD']) - strtotime(date("Y-m-d", time()))) / 86400) { ?>
                                            <p class="alert-auto alert-success text-center p-1 mb-0"><?php echo (strtotime($row['NVD']) - strtotime(date("Y-m-d", time()))) / 86400;
                                                                                                        ?> days more for next vaccination</p>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <p class="alert alert-light text-center"></p>
                                    <?php } ?>
                                    <?php
                                    if ($row['Weight'] != '' || $row['Weight'] != NULL) {
                                        $split = explode(',', $row['Weight']);
                                        $last_weight_record = end($split);
                                        $split = explode('_', $last_weight_record);
                                        $last_weight_date = array_shift($split);

                                        $next_weight_date = date("Y-m-d", strtotime($last_weight_date . ' + 28 days')); ?>

                                        <?php if (0 > (strtotime($next_weight_date) - strtotime(date("Y-m-d", time()))) / 86400) { ?>
                                            <p class="alert-auto alert-danger text-center p-1">Weight recording on <?php echo $next_weight_date; ?> missed</p>
                                        <?php } ?>
                                        <?php if (14 >= (strtotime($next_weight_date) - strtotime(date("Y-m-d", time()))) / 86400 && 0 <= (strtotime($next_weight_date) - strtotime(date("Y-m-d", time()))) / 86400) { ?>
                                            <p class="alert-auto alert-warning text-center p-1"><?php echo (strtotime($next_weight_date) - strtotime(date("Y-m-d", time()))) / 86400;
                                                                                                ?> days more to record weight</p>
                                        <?php } ?>
                                        <?php if (14 < (strtotime($next_weight_date) - strtotime(date("Y-m-d", time()))) / 86400) { ?>
                                            <p class="alert-auto alert-success text-center p-1"><?php echo (strtotime($next_weight_date) - strtotime(date("Y-m-d", time()))) / 86400;
                                                                                                ?> days more to record weight</p>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <p class="alert alert-light text-center"></p>
                                    <?php } ?>
                                    <p class="card-text m-0">Name: <?php echo $row["Name"] ?></p>
                                    <p class="card-text m-0">Birthdate: <?php echo $row["Birthday"] ?></p>
                                    <p class="card-text m-0">Midwife: <?php echo $row["MidwifeEmail"] ?></p>
                                    <p class="card-text m-0">Centre: <?php echo $row["Centre"] ?></p>
                                    <p class="card-text m-0">Next vaccination: <?php echo $row["NVD"] ?></p>
                                    <?php if ($row['Weight'] != '' || $row['Weight'] != NULL) { ?>
                                        <p class="card-text m-0">Next weight recording: <?php echo $next_weight_date ?></p>
                                    <?php } ?>
                                    <div class="text-center mt-2">
                                        <a href="./child_report.php/?ChildId=<?php echo $row["ChildId"] ?>" class="btn btn-outline-dark">View Child Report</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php
                    }
                    if ($count == 0) { ?>
                        <div class="row justify-content-center">

                            No child reports yet.
                        </div>
                    <?php } ?>

                </div>



            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>