<?php 
    include_once('config/db.php');
    include_once('autoloader.php');
    if (!isset($_SESSION['login'])) {
        header("Location: ./login.php");
    }
    if ($_SESSION['role'] == 'parent') {
        header("Location: ./dashboard.php");
    }
    if ($_SESSION['role'] == 'midwife') {
        header("Location: ./midwife.php");
    } 
    $search = '';
    if (isset($_GET['search'])) {
        $search = $_GET['search'];}
    $manager = new Manager($connection,$_SESSION['id'],$_SESSION['firstname']." ".$_SESSION['lastname'],$_SESSION['email']);

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $centre = $_POST['center'];
        $areas=$_POST['area'];
        $noc=$_POST['noc'];
        
        $manager->addMidwife($email,$centre,$areas,$noc);
        
    }

    $midwifeList=$manager-> getMidwives($search);
?>