<?php

ob_start();

if (!isset($_SESSION)) {
    session_start();
}


$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "child_care";

$connection = new mysqli($hostname, $username, $password, $dbname) or die("Database connection not established.");
