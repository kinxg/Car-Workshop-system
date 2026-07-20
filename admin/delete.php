<?php

session_start();

include("../db.php");

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn,"
DELETE FROM appointments
WHERE appointment_id='$id'
");

header("Location: dashboard.php");

?>