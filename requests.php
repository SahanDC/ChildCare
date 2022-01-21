<?php
include('config/db.php');
require_once('models/request.php');
require_once('models/manager.php');
if (!isset($_SESSION['login'])) {
    header("Location: ./login.php");
}
if ($_SESSION['role'] == 'parent') {
    header("Location: ./dashboard.php");
}
if ($_SESSION['role'] == 'midwife') {
    header("Location: ./midwife.php");
}
$manager = new Manager($connection, $_SESSION['id'], $_SESSION['firstname'] . " " . $_SESSION['lastname'], $_SESSION['email']);
$requestObj = new Request($connection);

if (isset($_POST['valid'])) {
    $requestObj->validateDocuments($_POST['reqId']);
    // $connection->query("UPDATE request set status = 'Valid' where id = '{$_POST['reqId']}'");
}

if (isset($_POST['invalid'])) {
    $requestObj->declineDocuments($_POST['reqId']);
    // $connection->query("UPDATE request set status = 'Invalid' where id = '{$_POST['reqId']}'");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="css/patientmanager_styles.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">

    <title>Patient Manager Home</title>
</head>

<body>
    <div class="px-3 py-2 text-black">
        <div class="container">
            <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                <li class="name">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                        <use xlink:href="#home" />
                    </svg>
                    <h3><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]
                        ?></h3>
                </li>
                <li class="details">
                    <h1>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</h1>
                </li>

                <li class="details">
                    <a href="manager.php" class="nav-link text-black">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                            <use xlink:href="#home" />
                        </svg>
                        <p class="hover-underline-animation">
                            Home
                        </p>
                    </a>
                </li>

                <li class="details">
                    <a href="<?php echo $manager->viewMedicalAdvices(); ?>" class="nav-link text-black">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                            <use xlink:href="#speedometer2" />
                        </svg>
                        <p class="hover-underline-animation">
                            Health Advice
                        </p>
                    </a>
                </li>
                <li class="details">
                    <a href="child report.php" class="nav-link text-black">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                            <use xlink:href="#table" />
                        </svg>
                        <p class="hover-underline-animation">
                            Child Reports
                        </p>
                    </a>
                </li>
                <li class="details">
                    <a href="requests.php" class="nav-link text-black">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                            <use xlink:href="#grid" />
                        </svg>
                        <p class="hover-underline-animation">
                            Child Report Request
                        </p>
                    </a>
                </li>
                <li class="details">
                    <!-- <a href="profile.php" class="nav-link text-white"> -->
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                        <use xlink:href="#people-circle" />
                    </svg><a class="btn btn-danger" href="./controllers/logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-xl mt-5 mb-5">

        <?php $requests = $requestObj->getRequests();
        $count = 0 ?>
        <h5 class="row justify-content-center mb-3">Child Report Requests</h5>
        <div class="accordion accordion-flush" id="accordionFlushExample">

            <?php foreach ($requests as $request) { ?>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading<?= $count ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?= $count ?>" aria-expanded="false" aria-controls="flush-collapseOne<?= $count ?>">
                            <?php $request = $requestObj->getRequestById($request['id']);
                            $requestID = $request['id'];
                            // $row = $query->fetch_assoc();

                            $parent_id = $request["parent_id"];
                            $query_parent = $connection->query("SELECT * FROM user where id = '{$parent_id}'");
                            ?>
                            <div class="col-1">

                                ID:
                                <?php
                                echo $request["id"]; ?>
                            </div>
                            <div class="col-4">

                                Parent:
                                <?php
                                while ($parent = mysqli_fetch_array($query_parent)) {
                                    echo $parent["firstname"] . " " . $parent["lastname"] . "\n";
                                } ?>
                            </div>

                            <div class="col-4">

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
                                // $request = $query->fetch_assoc();

                                $file1 = './requests/' . $request["birth_certificate"];
                                $parent_id = $request["parent_id"];
                                $query_parent = $connection->query("SELECT * FROM user where id = '{$parent_id}'");
                                ?>


                                <h4 class="mt-4">Birth certificate </h4>
                                <div class="row p-2">
                                    <a style="text-decoration: none; display:inline-block" href="<?php echo $file1; ?>" target="_blank"><i class="fas fa-file p-1"></i> Open in a new tab</a>
                                </div>
                                <iframe src="<?php echo $file1; ?>" width="90%" height="500px">
                                </iframe>

                                <h4 class="mt-4">Clinic card</h4>
                                <?php
                                if ($request["clinic_card"] == NULL) { ?>
                                    <p> The child doesn't have a child report. </p>
                                <?php
                                } else {
                                    $file2 = './requests/' . $request["clinic_card"];
                                ?>
                                    <div class="row p-2">
                                        <a style="text-decoration: none;" href="<?php echo $file2; ?>" target="_blank"><i class="fas fa-file p-1"></i> Open in a new tab</a>
                                    </div>
                                    <iframe src="<?php echo $file2; ?>" width="90%" height="500px">
                                    </iframe>
                                <?php } ?>

                                <!-- <div class="container "> -->
                                <div class="row p-3 m-3 justify-content-center">
                                    <div class="col-sm-8 col-md-6 col-lg-5 col-xl-4 text-center mb-1 <?php if ($request["status"] == 'Created' || $request["status"] == 'Invalid' || $request["status"] == 'New') echo ('d-none') ?>">

                                        <a class="btn btn-primary px-5 w-100" href="./create_child_report.php?id=<?= $requestID ?>" target="_blank">Create Child Report</a>
                                    </div>
                                    <div class="col-sm-8 col-md-6 col-lg-5 col-xl-4 text-center mb-1 <?php if ($request['status'] == 'Valid' || $request['status'] == 'Created') echo ('d-none') ?>">
                                        <form action="" method="post">
                                            <input type="hidden" id="reqId" name="reqId" value="<?php echo $requestID ?>">
                                            <input class="btn btn-success px-5 w-100" type="submit" name="valid" onclick="window.open('./create_child_report.php?id=<?= $requestID ?>')" value="Validate Documents">
                                            <!-- <input class="btn btn-success px-5 w-100" type="submit" name="valid" value="Validate Documents"> -->
                                        </form>
                                    </div>
                                    <div class="col-sm-8 col-md-6 col-lg-5 col-xl-4 text-center mb-1 <?php if ($request['status'] == 'Invalid' || $request['status'] == 'Created') echo ('d-none') ?>">
                                        <form action="" method="post">
                                            <input type="hidden" id="reqId" name="reqId" value="<?php echo $requestID ?>">
                                            <input class="btn btn-danger px-5 w-100" type="submit" name="invalid" value="Decline Documents">
                                        </form>
                                    </div>

                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>

            <?php $count++;
            } ?>
        </div>
        <?php if ($count == 0) { ?>
            <div class="row justify-content-left">

                No child report requests yet.
            </div>
        <?php } ?>
    </div>

    <!-- footer section starts -->
    <footer>
        <section class="footer">

            <div class="container">

                <div class="row">

                    <div class="col-md-6" data-aos="fade-right">
                        <a href="#" class="logo"><span>C</span>hild <span>C</span>are <span>M</span>anagement <span>S</span>ystem</a>
                        <p>Our child care management system allows parents, and midwives to access everything securely about the children remotely at their fingertips</p>
                    </div>

                    <div class="col-md-6 text-center" data-aos="fade-left">
                        <h3>share</h3>
                        <a href="#">Facebook</a>
                        <a href="#">Twitter</a>
                        <a href="#">Linkedin</a>
                        <a href="#">Github</a>
                    </div>

                </div>

            </div>

            <h4 class="credit text-center mx-auto">created by <span>TEAM NINJAS-GROUP 23</span> | all rights reserved.</h4>

        </section>
    </footer>



    <!-- footer section ends -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>