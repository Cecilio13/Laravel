<?php
$ipaddress="localhost";
$pass="root";
$user="root";
$db="accounting";
error_reporting(0);
$conn = mysqli_connect($ipaddress, $user, $pass,$db);
mysqli_set_charset($conn, "utf8");

?>