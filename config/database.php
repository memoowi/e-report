<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "e-report";

try {

    $conn = mysqli_connect($hostname, $username, $password, $dbname);
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
