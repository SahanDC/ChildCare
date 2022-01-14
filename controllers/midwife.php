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

$midwifeObj3 = new Midwife($connection, $mail);
$vaccinateWithinTwoWeeks = $midwifeObj3->getChildReportDetails($mail, '');

$midwifeObj4 = new Midwife($connection, $mail);
$vaccinationMissed = $midwifeObj4->getChildReportDetails($mail, '');
