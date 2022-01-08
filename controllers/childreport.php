<?php 
include("./config/db.php");
include_once('models/childreport.php');
if (!isset($_SESSION['login'])) {
    header("Location: ./login.php");
}

//print_r($_POST);// print_r($_POST);
$ChildId;
$name = '';
$age = '';
$guardian = '';
$birth_place = '';
$user = $_SESSION['role'];
//$user = "parent";
$last_vaccination;
$vaccine_data = array();
$weights = array();

$edit_vaccine = '';
$edit_date = '';
$edit_place = '';
$edit_NVdate = '';
$edit_comment = '';
$add_vaccine = '';
$add_Vdate = '';
$add_place = '';
$add_NVdate = '';
$add_comment = '';
$add_Wdate = '';
$add_weight = '';
$errors = array();
//print_r($_GET);

if (isset($_GET['ChildId'])) {
    $ChildId = $_GET['ChildId'];
    //echo $ChildId;
}

if (isset($_POST['edit'])) {
    $last_vaccination = $_POST['last_vaccination'];
    $edit_vaccine = $_POST['edit_vaccine'];
    $edit_date = trim($_POST['edit_date']);
    $edit_place = trim($_POST['edit_place']);
    $edit_NVdate = trim($_POST['edit_NVdate']);
    $edit_comment = trim($_POST['edit_comment']);
    $ChildId = $_POST['ChildId'];
    
    //echo $edit_NVdate;
    $report1 = new ChildReport($ChildId);
    $report1->editVaccination($edit_vaccine, $edit_date, $edit_place, $edit_NVdate, $edit_comment);
    if ($report1->checkErrors()){
        $edit_vaccine = '-1';
        $edit_date = '';
        $edit_place = '';
        $edit_comment = '';
        $edit_NVdate = '';
    }
    //print_r($report1->Errors);
}

if (isset($_POST['add_V'])) {
    $last_vaccination = $_POST['last_vaccination'];
    $add_vaccine = $_POST['add_vaccine'];
    $add_Vdate = $_POST['add_Vdate'];
    $add_place = $_POST['add_place'];
    $add_NVdate = trim($_POST['add_NVdate']);
    $add_comment = $_POST['add_comment'];
    $ChildId = $_POST['ChildId'];
    
    $report1 = new ChildReport($ChildId);
    $report1->addVaccination($add_vaccine, $add_Vdate, $add_place, $add_NVdate, $add_comment);
    if ($report1->checkErrors()){
        $add_vaccine = '-1';
        $add_Vdate = '';
        $add_place = '';
        $add_comment = '';
        $add_NVdate = '';
    }
}

if (isset($_POST['add_W'])) {
    $add_Wdate = $_POST['add_Wdate'];
    $add_weight = $_POST['add_weight'];
    $ChildId = $_POST['ChildId'];
    $added_weights = $_POST['added_weights'];
    
    $report1 = new ChildReport($ChildId);
    $report1->addWeight($added_weights,$add_Wdate,$add_weight);
    if ($report1->checkErrors()){
        $add_Wdate = '';
        $add_weight = '';
    }
}

if (!empty($ChildId)) {
    $report2 = new ChildReport($ChildId);
    $report2->openChildReport();
    $name = $report2->getName();
    $age = $report2->getAge();
    $guardian = $report2->getGuardian();
    $birth_place = $report2->getBirthPlace();
    $vaccine_data = $report2->getVaccineData();
    $last_vaccination = $report2->getLastVaccination();
    $weights = $report2->getWeights();
}


//functions to display the eroors
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

?>