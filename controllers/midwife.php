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
$_SESSION['type'] = 'Midwife';

$midwifeObj = new Midwife($connection);
$details = $midwifeObj->getDetails();   // all the details in the midwife table

$midwifeObj2 = new Midwife($connection);
$childReportDetails = $midwifeObj2->getChildReportDetails($mail, $search);  // all the details in the child report table that belongs to the relevant midwife

?>