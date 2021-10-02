<?php

$dbServername = "localhost";
$user = "root";
$password = "";
$dbName = "soen341";

$db = mysqli_connect($dbServername,$user,$password,$dbName) or die("Connection failed to database.");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


?>
