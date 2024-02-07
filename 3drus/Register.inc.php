<?php

if(isset($_POST ["submitF"])) {
	echo "Processing";
	$AccountName = $_POST["fname"];
	$AccountEmail = $_POST["email"];
	$AccountUsername =  $_POST["username"];
	$AccountPwd = $_POST["password"];
	$AccountPwdRe = $_POST["repassword"];

	require_once 'Database_Con.inc.php';

	require_once 'Functions.inc.php';

	if(emptyInputSignup($AccountName, $AccountEmail, $AccountUsername, $AccountPwd, $AccountPwdRe) !== false){
		header("location:Register.php?error=emptyinput");
		exit();
	}

	if(InvalidAcName($AccountUsername) !== false){
		header("location:Register.php?error=invalidaccountname");
		exit();
	}

	if(InvalidEmail($AccountEmail) !== false){
		header("location:Register.php?error=invalidemail");
		exit();
	}

	if(PwdCheck($AccountPwd, $AccountPwdRe) !== false){
		header("location:Register.php?error=passworddontmatch");
		exit();
	}

	if(AccountTaken($conn, $AccountUsername, $AccountEmail) !== false){
		header("location:Register.php?error=usernametaken");
		exit();
	}

	CreateUser($conn, $AccountName, $AccountEmail, $AccountUsername, $AccountPwd);

}
else {
	header("location:Login.php");
	exit();
}