<?php
include_once('config/db.php');

// if ($_SESSION['role'] == 'parent') {
//     header("Location: ./dashboard.php");
// }
// if ($_SESSION['role'] == 'midwife') {
//     header("Location: ./midwife.php");
// }

?>

<?php
$child_name = '';
$birthday = '';
$guardian = '';
$guardian_id = '';
$birth_place = '';
$area = '';
$center = '';
$midwife_email = '';
$NVD = '';

$date_BCG = '';
$place_BCG = '';
$comment_BCG = '';

$date_triple = '';
$place_triple = '';
$comment_triple = '';

$date_triple_polio = '';
$place_triple_polio = '';
$comment_triple_polio = '';

$date_MMR = '';
$place_MMR = '';
$comment_MMR = '';

$date_JE = '';
$place_JE = '';
$comment_JE = '';

$date_dual_polio = '';
$place_dual_polio = '';
$comment_dual_polio = '';

$date_HAB = '';
$place_HAB = '';
$comment_HAB = '';

$date_AR = '';
$place_AR = '';
$comment_AR = '';

$date_CP = '';
$place_CP = '';
$comment_CP = '';

$date_Men = '';
$place_Men = '';
$comment_Men = '';

$errors = array();

function check_req_fields($req_fields)
{
    // checks required fields
    $errors = array();

    foreach ($req_fields as $field) {
        if (empty(trim($_POST[$field]))) {
            $errors[] = $field . ' is required.';
        }
    }
    return $errors;
}

function display_errors($errors)
{
    // format and displays form errors
    echo '<div class="container col-6 text-center bg-danger bg-opacity-75 p-3 rounded">';
    echo '<b>There were error(s) on your form.</b><br>';
    foreach ($errors as $error) {
        $error = ucfirst(str_replace("_", " ", $error));
        echo $error . '<br>';
    }
    echo '</div>';
}

if (isset($_POST['submit'])) {
    // print_r($_POST);
    $child_name = $_POST['child_name'];
    $birthday = $_POST['birthday'];
    $guardian = $_POST['guardian'];
    $guardian_id = $_POST['guardian_id'];
    $birth_place = $_POST['birth_place'];
    $area = $_POST['area'];
    $center = $_POST['center'];
    $midwife_email = $_POST['midwife_email'];
    $NVD = $_POST['NVD'];

    $date_BCG = $_POST['date_BCG'];
    $place_BCG = $_POST['place_BCG'];
    $comment_BCG = $_POST['comment_BCG'];
    $BCG = ($date_BCG == '' && $place_BCG == '') ? '' : date("Y/m/d", strtotime($date_BCG)) . '_' . $place_BCG . '_' . $comment_BCG;
    echo $BCG;

    $date_triple = $_POST['date_triple'];
    $place_triple = $_POST['place_triple'];
    $comment_triple = $_POST['comment_triple'];
    $triple = ($date_triple == '' && $place_triple == '') ? '' : date("Y/m/d", strtotime($date_triple)) . '_' . $place_triple . '_' . $comment_triple;


    $date_triple_polio = $_POST['date_triple_polio'];
    $place_triple_polio = $_POST['place_triple_polio'];
    $comment_triple_polio = $_POST['comment_triple_polio'];
    $triple_polio = ($date_triple_polio == '' && $place_triple_polio == '') ? '' : date("Y/m/d", strtotime($date_triple_polio)) . '_' . $place_triple_polio . '_' . $comment_triple_polio;


    $date_MMR = $_POST['date_MMR'];
    $place_MMR = $_POST['place_MMR'];
    $comment_MMR = $_POST['comment_MMR'];
    $MMR = ($date_MMR == '' && $place_MMR == '') ? '' : date("Y/m/d", strtotime($date_MMR)) . '_' . $place_MMR . '_' . $comment_MMR;


    $date_JE = $_POST['date_JE'];
    $place_JE = $_POST['place_JE'];
    $comment_JE = $_POST['comment_JE'];
    $JE = ($date_JE == '' && $place_JE == '') ? '' : date("Y/m/d", strtotime($date_JE)) . '_' . $place_JE . '_' . $comment_JE;


    $date_dual_polio = $_POST['date_dual_polio'];
    $place_dual_polio = $_POST['place_dual_polio'];
    $comment_dual_polio = $_POST['comment_dual_polio'];
    $dual_polio = ($date_dual_polio == '' && $place_dual_polio == '') ? '' : date("Y/m/d", strtotime($date_dual_polio)) . '_' . $place_dual_polio . '_' . $comment_dual_polio;


    $date_HAB = $_POST['date_HAB'];
    $place_HAB = $_POST['place_HAB'];
    $comment_HAB = $_POST['comment_HAB'];
    $HAB = ($date_HAB == '' && $place_HAB == '') ? '' : date("Y/m/d", strtotime($date_HAB)) . '_' . $place_HAB . '_' . $comment_HAB;


    $date_AR = $_POST['date_AR'];
    $place_AR = $_POST['place_AR'];
    $comment_AR = $_POST['comment_AR'];
    $AR = ($date_AR == '' && $place_AR == '') ? '' : date("Y/m/d", strtotime($date_AR)) . '_' . $place_AR . '_' . $comment_AR;


    $date_CP = $_POST['date_CP'];
    $place_CP = $_POST['place_CP'];
    $comment_CP = $_POST['comment_CP'];
    $CP = ($date_CP == '' && $place_CP == '') ? '' : date("Y/m/d", strtotime($date_CP)) . '_' . $place_CP . '_' . $comment_CP;


    $date_Men = $_POST['date_Men'];
    $place_Men = $_POST['place_Men'];
    $comment_Men = $_POST['comment_Men'];
    $Men = ($date_Men == '' && $place_Men == '') ? '' : date("Y/m/d", strtotime($date_Men)) . '_' . $place_Men . '_' . $comment_Men;


    $not_null = array('child_name', 'birthday', 'guardian', 'guardian_id', 'birth_place', 'area', 'center', 'midwife_email');
    $errors = array_merge($errors, check_req_fields($not_null));

    $query = "INSERT INTO child_report(Name, Birthday, Guardian, GuardianId, BirthPlace, Area, Centre, MidwifeEmail, NVD, BCG, Triple, Triple_Polio, MMR, Japanese_Encephalitis, Dual_Polio, Hepatitis_AB, Anti_Rabies, Chicken_Pox, Meningicoccal) VALUES('{$child_name}','{$birthday}','{$guardian}','{$guardian_id}','{$birth_place}','{$area}','{$center}','{$midwife_email}','{$NVD}', '{$BCG}', '{$triple}','{$triple_polio}','{$MMR}','{$JE}','{$dual_polio}','{$HAB}','{$AR}','{$CP}','{$Men}')";

    if (empty($errors)) {
        $insert_query = mysqli_query($connection, $query);

        if ($insert_query) {
            header('Location:midwife.php?'); 
        } else {
            $errors[] = 'Failed to Add a report';
        }
    }
    

    
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Child Report</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="btn btn-primary" href="#" role="button">See Medical Advice</a>
            <a class="btn btn-danger" href="#" role="button">Log Out</a>
        </div>
    </nav>

    <?php
    if (!empty($errors)) {
        display_errors($errors);
    }
    ?>

    <div class="container">
        <form action="create_child_report.php" method="post">
            <div class="mb-3">
                <label class="form-label">Child Name</label>
                <input type="text" class="form-control" name="child_name" placeholder=" Child Name " value=<?php echo $child_name ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Birthday</label>
                <input type="date" class="form-control" name="birthday" value=<?php echo $birthday ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Guardian Name</label>
                <input type="text" class="form-control" name="guardian" placeholder=" Guardian Name " value=<?php echo $guardian ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Guardian Id</label>
                <input type="text" class="form-control" name="guardian_id" placeholder=" Guardian Id " value=<?php echo $guardian_id ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Birth Place</label>
                <input type="text" class="form-control" name="birth_place" placeholder=" Birth Place " value=<?php echo $birth_place ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Living Area</label>
                <input type="text" class="form-control" name="area" placeholder=" Living Area " value=<?php echo $area ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Closest Vaccination Center</label>
                <input type="text" class="form-control" name="center" placeholder=" Closest Vaccination Center " value=<?php echo $center ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Midwife blongs to</label>
                <input type="email" class="form-control" name="midwife_email" placeholder=" Midwife email address " value=<?php echo $midwife_email ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Next Vaccination Date</label>
                <input type="date" class="form-control" name="NVD" value=<?php echo $NVD ?>>
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
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>