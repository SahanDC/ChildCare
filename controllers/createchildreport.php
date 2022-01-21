<?php

include_once('config/db.php');
include_once('models/request.php');


$child_name = '';
$birthday = '';
$guardian = '';
//$guardian_id = '';
$Request_id = '';
$birth_place = '';
$area = '';
$center = '';
$midwife_email = '';
$NVD = '';
$Weight_details = '';

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

if (isset($_GET['id'])) {
    $Request_id = $_GET['id'];
}

// $manager = new Manager($connection, $_SESSION['id'], $_SESSION['firstname'] . " " . $_SESSION['lastname'], $_SESSION['email']);
// function check_req_fields($req_fields)
// {
//     // checks required fields
//     $errors = array();

//     foreach ($req_fields as $field) {
//         if (empty(trim($_POST[$field]))) {
//             $errors[] = $field . ' is required.';
//         }
//     }
//     return $errors;
// }




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
    print_r($_POST);
    $child_name = $_POST['child_name'];
    $birthday = $_POST['birthday'];
    $guardian = $_POST['guardian'];
    //$guardian_id = $_POST['guardian_id'];
    $Request_id = $_POST['Request_id'];
    $birth_place = $_POST['birth_place'];
    $area = $_POST['area'];
    $center = $_POST['center'];
    $midwife_email = $_POST['midwife_email'];
    $NVD = $_POST['NVD'];
    $vaccines = array();
    $Weight_details = $_POST['Weight_details'];

    $date_BCG = $_POST['date_BCG'];
    $place_BCG = $_POST['place_BCG'];
    $comment_BCG = $_POST['comment_BCG'];
    $BCG = ($date_BCG == '' && $place_BCG == '') ? '' : date("Y/m/d", strtotime($date_BCG)) . '_' . $place_BCG . '_' . $comment_BCG;
    array_push($vaccines, $BCG);
    //echo $BCG;

    $date_triple = $_POST['date_triple'];
    $place_triple = $_POST['place_triple'];
    $comment_triple = $_POST['comment_triple'];
    $triple = ($date_triple == '' && $place_triple == '') ? '' : date("Y/m/d", strtotime($date_triple)) . '_' . $place_triple . '_' . $comment_triple;
    array_push($vaccines, $triple);

    $date_triple_polio = $_POST['date_triple_polio'];
    $place_triple_polio = $_POST['place_triple_polio'];
    $comment_triple_polio = $_POST['comment_triple_polio'];
    $triple_polio = ($date_triple_polio == '' && $place_triple_polio == '') ? '' : date("Y/m/d", strtotime($date_triple_polio)) . '_' . $place_triple_polio . '_' . $comment_triple_polio;
    array_push($vaccines, $triple_polio);

    $date_MMR = $_POST['date_MMR'];
    $place_MMR = $_POST['place_MMR'];
    $comment_MMR = $_POST['comment_MMR'];
    $MMR = ($date_MMR == '' && $place_MMR == '') ? '' : date("Y/m/d", strtotime($date_MMR)) . '_' . $place_MMR . '_' . $comment_MMR;
    array_push($vaccines, $MMR);

    $date_JE = $_POST['date_JE'];
    $place_JE = $_POST['place_JE'];
    $comment_JE = $_POST['comment_JE'];
    $JE = ($date_JE == '' && $place_JE == '') ? '' : date("Y/m/d", strtotime($date_JE)) . '_' . $place_JE . '_' . $comment_JE;
    array_push($vaccines, $JE);

    $date_dual_polio = $_POST['date_dual_polio'];
    $place_dual_polio = $_POST['place_dual_polio'];
    $comment_dual_polio = $_POST['comment_dual_polio'];
    $dual_polio = ($date_dual_polio == '' && $place_dual_polio == '') ? '' : date("Y/m/d", strtotime($date_dual_polio)) . '_' . $place_dual_polio . '_' . $comment_dual_polio;
    array_push($vaccines, $dual_polio);

    $date_HAB = $_POST['date_HAB'];
    $place_HAB = $_POST['place_HAB'];
    $comment_HAB = $_POST['comment_HAB'];
    $HAB = ($date_HAB == '' && $place_HAB == '') ? '' : date("Y/m/d", strtotime($date_HAB)) . '_' . $place_HAB . '_' . $comment_HAB;
    array_push($vaccines, $HAB);

    $date_AR = $_POST['date_AR'];
    $place_AR = $_POST['place_AR'];
    $comment_AR = $_POST['comment_AR'];
    $AR = ($date_AR == '' && $place_AR == '') ? '' : date("Y/m/d", strtotime($date_AR)) . '_' . $place_AR . '_' . $comment_AR;
    array_push($vaccines, $AR);

    $date_CP = $_POST['date_CP'];
    $place_CP = $_POST['place_CP'];
    $comment_CP = $_POST['comment_CP'];
    $CP = ($date_CP == '' && $place_CP == '') ? '' : date("Y/m/d", strtotime($date_CP)) . '_' . $place_CP . '_' . $comment_CP;
    array_push($vaccines, $CP);

    $date_Men = $_POST['date_Men'];
    $place_Men = $_POST['place_Men'];
    $comment_Men = $_POST['comment_Men'];
    $Men = ($date_Men == '' && $place_Men == '') ? '' : date("Y/m/d", strtotime($date_Men)) . '_' . $place_Men . '_' . $comment_Men;
    array_push($vaccines, $Men);


    // $success = $manager->createChildReport($child_name, $birthday, $guardian, $Request_id, $birth_place, $area, $center, $midwife_email, $NVD, $vaccines);

    $requestObj = new Request($connection);

    $request = $requestObj->getRequestById($Request_id);
    $guardianId = $request['parent_id'];
    $childreport = ChildReport::cloneChildreport();
    if ($request['clinic_card'] != null) {
        $errors = $childreport->createChildReport($child_name, $birthday, $guardian, $guardianId, $Request_id, $birth_place, $area, $center, $midwife_email, $NVD, $vaccines,$Weight_details);
        $requestObj->createReport($Request_id);
    } else {
        $errors = $childreport->createChildReport_Noreport($child_name, $birthday, $guardian, $guardianId, $Request_id, $birth_place, $area, $center, $midwife_email, $NVD);
        $requestObj->createReport($Request_id);
    }


    array_merge($this->Errors, $errors);
    if (empty($errors)) {
        // $requestobj->createReport($Request_id);
        array_push($this->Errors, "change state");
    }


    // $requestObj = new Request($connection);

    // $not_null = array('child_name', 'birthday', 'guardian', 'guardian_id', 'birth_place', 'area', 'center', 'midwife_email');
    // $errors = array_merge($errors, check_req_fields($not_null));

    // $query = "INSERT INTO child_report(Name, Birthday, Guardian, GuardianId, BirthPlace, Area, Centre, MidwifeEmail, NVD, BCG, Triple, Triple_Polio, MMR, Japanese_Encephalitis, Dual_Polio, Hepatitis_AB, Anti_Rabies, Chicken_Pox, Meningicoccal) VALUES('{$child_name}','{$birthday}','{$guardian}','{$guardian_id}','{$birth_place}','{$area}','{$center}','{$midwife_email}','{$NVD}', '{$BCG}', '{$triple}','{$triple_polio}','{$MMR}','{$JE}','{$dual_polio}','{$HAB}','{$AR}','{$CP}','{$Men}')";

    // if (empty($errors)) {
    //     $insert_query = mysqli_query($connection, $query);

    //     if ($insert_query) {
    //         header('Location:midwife.php?'); 
    //     } else {
    //         $errors[] = 'Failed to Add a report';
    //     }
    // }
    // if ($success == 0) {

    // }
    // $connection->query("UPDATE request set status = 'Valid' where id = '{$_POST['reqId']}'");

}
