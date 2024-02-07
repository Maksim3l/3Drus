<?php

if (isset($_POST["submitL"])){

	$AccountUsername = $_POST["nameEm"];
	$AccountPwd = $_POST["password"];
	
	require_once 'Database_Con.inc.php';

	require_once 'functions.inc.php';

	if(emptyInputLogin($AccountUsername, $AccountPwd) !== false){
		header("location:Login.php?error=emptyinput");
		exit();
	} 
	

	LoginAccount($conn, $AccountUsername, $AccountPwd);

		
}
else{
	header("location:Home.php");
	exit();
}