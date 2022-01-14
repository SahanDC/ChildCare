<?php include('config/db.php');
require_once('models/midwife.php');
if (!isset($_SESSION['login'])) {
    header("Location: ./login.php");
}
if ($_SESSION['role'] == 'manager') {
    header("Location: ./manager.php");
}
if ($_SESSION['role'] == 'parent') {
    header("Location: ./dashboard.php");
}
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$mail = $_SESSION['email'];
// echo $_SESSION['email'];

$_SESSION['type'] = 'Midwife';

$midwifeObj = new Midwife($connection, $mail);
$details = $midwifeObj->getDetails();

$midwifeObj2 = new Midwife($connection, $mail);
$childReportDetails = $midwifeObj2->getChildReportDetails($mail, $search);

$vaccinationWithin2Weeks = $midwifeObj2->vaccinationWithin2Weeks($childReportDetails);
$vaccinationMissed = $midwifeObj2->vaccinationMissed($childReportDetails);
