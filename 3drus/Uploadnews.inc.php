<?php
session_start();

if (isset($_POST["UploadB"])){

	$NewsTitle = $_POST["NewsTitle"];

	$NewsCaption = $_POST["NewsCaption"];
	$NewsText = $_POST["NewsText"];

	$NewsDate = date("Y/m/d");
	$AuthorId = $_SESSION["accountid"];

	require_once 'Database_Con.inc.php';

	require_once 'functions.inc.php';

	
	UploadNews($conn, $AuthorId, $NewsTitle, $NewsCaption, $NewsText, $NewsDate);

}
else{
	header("location:Search.php");
	exit();
}
