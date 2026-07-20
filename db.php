<?php

$host = "sql208.infinityfree.com";
$username = "if0_42455070";
$password = "hoteltrivago50";
$database = "if0_42455070_car_workshop";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

?>