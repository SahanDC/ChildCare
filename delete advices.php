<?php session_start();?>
<?php require_once('config/db.php');
?>
<?php

    include "connection.php"; // Using database connection file here

    $id = $_GET['id']; // get id through query string
    $query="UPDATE advice SET isdeleted=1 WHERE id= {$id} LIMIT 1";
    $del = mysqli_query($connection,$query); // delete query

    if($del)
    {
        echo "1111111111111111111111111111111111111111111111111111111111111";
        header("location:health advices.php"); // redirects to all records page
        exit;	
    }
    else
    {   echo mysqli_connect_error();
        echo "Error deleting record";
        echo mysqli_connect_error(); // display error message if not delete
    }
?>

