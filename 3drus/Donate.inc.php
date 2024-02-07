<?php
session_start();
if (isset($_POST["DonateB"])){

	$DonationTitle = $_POST["DonationTitle"];
	$DonationText = $_POST["DonationText"];
	$DonationAmount = $_POST["DonationAmount"];
	$Currency = filter_input(INPUT_POST, 'currency', FILTER_SANITIZE_STRING);
	$DonerId = $_SESSION["accountid"];

	require_once 'Database_Con.inc.php';

	require_once 'functions.inc.php';






	

	

 
	
	Donate($conn, $DonerId, $DonationTitle, $DonationText, $DonationAmount, $Currency);

}
else{
	header("location:Home.php");
	exit();
}