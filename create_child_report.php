<?php
include_once('config/db.php');
include_once('models/manager.php');
include_once('models/request.php');

include('controllers/createchildreport.php');
if ($_SESSION['role'] == 'parent') {
    header("Location: ./dashboard.php");
}
if ($_SESSION['role'] == 'midwife') {
    header("Location: ./midwife.php");
}

$manager = new Manager($connection,$_SESSION['id'],$_SESSION['firstname']." ".$_SESSION['lastname'],$_SESSION['email']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/create_child_report_Style.css">
    <title>Child Report</title>
</head>


<body>
    

    <!-- header section starts  -->
    <header style="background-color: rgb(181, 239, 241);">
        <div class="container" style="background-color: rgb(181, 239, 241);">
            <a href="#" class="logo"><span>C</span>hild <span>C</span>are <span>M</span>anagement <span>S</span>ystem.</a>
            <nav class="nav">
                <ul>
                    <li><a href="">See Medical Advice</a></li>
                    <li><a href="./controllers/logout.php">Log Out</a></li>
                </ul>
            </nav>
            <div class="fas fa-bars"></div>
        </div>
    </header>
    <!-- header section ends  -->

    <?php
    if (!empty($manager->Errors)) {
        display_errors($manager->Errors);
    }
    ?>

    <div class="container">
        <form action="create_child_report.php" method="post">
            <div class="mb-3">
                <label class="form-label">Child Name</label>
                <input type="text" class="form-control" required name="child_name" placeholder=" Child Name " value=<?php echo $child_name ?>  >
            </div>
            <div class="mb-3">
                <label class="form-label">Birthday</label>
                <input type="date" class="form-control" required name="birthday" value=<?php echo $birthday ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Guardian Name</label>
                <input type="text" class="form-control" required name="guardian" placeholder=" Guardian Name " value=<?php echo $guardian ?>  >
            </div>
            <!-- <div class="mb-3">
                <label class="form-label">Guardian Id</label>
                <input type="hidden" class="form-control" name="guardian_id" placeholder=" Guardian Id " value=<?php echo $guardian_id ?>>
            </div> -->
            <!-- <div class="mb-3">
                <label class="form-label">Request Id</label> -->
            <input type="hidden" class="form-control" required name="Request_id" placeholder=" Request Id " value=<?php echo $Request_id ?>  >
            <!-- </div> -->
            <div class="mb-3">
                <label class="form-label">Birth Place</label>
                <input type="text" class="form-control" required name="birth_place" placeholder=" Birth Place " value=<?php echo $birth_place ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Living Area</label>
                <input type="text" class="form-control" required name="area" placeholder=" Living Area " value=<?php echo $area ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Closest Vaccination Center</label>
                <input type="text" class="form-control" required name="center" placeholder=" Closest Vaccination Center " value=<?php echo $center ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Midwife blongs to</label>
                <input type="email" class="form-control" required name="midwife_email" placeholder=" Midwife email address " value=<?php echo $midwife_email ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Next Vaccination Date</label>
                <input type="date" class="form-control" required name="NVD" value=<?php echo $NVD ?>>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">BCG Vaccine</label>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="date_BCG" value=<?php echo $date_BCG ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="place_BCG" place placeholder=" Place of Vaccination" value=<?php echo $place_BCG ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="comment_BCG" placeholder=" Comments on Vaccination " value=<?php echo $comment_BCG ?>>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Triple Vaccine</label>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="date_triple" value=<?php echo $date_triple ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="place_triple" placeholder=" Place of Vaccination" value=<?php echo $place_triple ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="comment_triple" placeholder=" Comments on Vaccination " value=<?php echo $comment_triple ?>>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Triple/Polio Vaccine</label>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="date_triple_polio" value=<?php echo $date_triple_polio ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="place_triple_polio" placeholder=" Place of Vaccination" value=<?php echo $place_triple_polio ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="comment_triple_polio" placeholder=" Comments on Vaccination " value=<?php echo $comment_triple_polio ?>>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">MMR Vaccine</label>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="date_MMR" value=<?php echo $date_MMR ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="place_MMR" placeholder=" Place of Vaccination" value=<?php echo $place_MMR ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="comment_MMR" placeholder=" Comments on Vaccination " value=<?php echo $comment_MMR ?>>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Japanese Encephalitis Vaccine</label>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="date_JE" value=<?php echo $date_JE ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="place_JE" placeholder=" Place of Vaccination" value=<?php echo $place_JE ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="comment_JE" placeholder=" Comments on Vaccination " value=<?php echo $comment_JE ?>>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Dual Polio Vaccine</label>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="date_dual_polio" value=<?php echo $date_dual_polio ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="place_dual_polio" placeholder=" Place of Vaccination" value=<?php echo $place_dual_polio ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="comment_dual_polio" placeholder=" Comments on Vaccination " value=<?php echo $comment_dual_polio ?>>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Hepatitis A, B Vaccine</label>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="date_HAB" value=<?php echo $date_HAB ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="place_HAB" placeholder=" Place of Vaccination" value=<?php echo $place_HAB ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="comment_HAB" placeholder=" Comments on Vaccination " value=<?php echo $comment_HAB ?>>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Anti Rabies Vaccine</label>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="date_AR" value=<?php echo $date_AR ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="place_AR" placeholder=" Place of Vaccination" value=<?php echo $place_AR ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="comment_AR" placeholder=" Comments on Vaccination " value=<?php echo $comment_AR ?>>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Chicken Pox Vaccine</label>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="date_CP" value=<?php echo $date_CP ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="place_CP" placeholder=" Place of Vaccination" value=<?php echo $place_CP ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="comment_CP" placeholder=" Comments on Vaccination " value=<?php echo $comment_CP ?>>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Meningicoccal Vaccine</label>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="date_Men" value=<?php echo $date_Men ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="place_Men" placeholder=" Place of Vaccination" value=<?php echo $place_Men ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="comment_Men" placeholder=" Comments on Vaccination " value=<?php echo $comment_Men ?>>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Weight details</label>
                <input type="text" class="form-control" name="Weight_details" placeholder="Weight details" value=<?php echo $Weight_details ?>>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>