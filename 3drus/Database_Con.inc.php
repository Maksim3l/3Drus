<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "3drus";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

if (!$conn){
	die ("Con failed:" . mysqli_connect_error);
}