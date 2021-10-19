<?php

$dbServername = "homep4.ddns.net";
$user = "access";
$password = "SOEN341&test321";
$dbName = "soen341";

$db = mysqli_connect($dbServername,$user,$password,$dbName,3306) or die("Connection failed to database.");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();

}

else {
	//echo "Connect Successfully. <br>Host info: " . mysqli_get_host_info($db) . "<br>";
}

?>

