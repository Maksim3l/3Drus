<?php
	session_start();
?>


<!DOCTYPE html>
 	<html>

	<head>
		<link rel="stylesheet" href="3drus.css">
		<link REL="SHORTCUT ICON" HREF="Smol.ico">
		<title>3D R US</title>
	</head>

	<body>


		<h1>3D R US</h1>

		
		<div id="hopes" class="nav">

			<a class="avi" href="Home.php">Home</a> | 
			<a class="avi" href="Search.php">Search</a> | 
			<a class="avi" href="About_us.php">About us</a> | 
			 
			<?php
				if(isset($_SESSION["accountid"])){
					echo"<a class='avi' href='Donate.php'>Donate</a> | ";
					echo"<a class='avi' href='Upload.php'>Upload</a> | ";
					echo"<a class='avi' href='Profile.php'>Profile</a>";
				}
				
				else {
					echo"<a class='avi' href='Login.php'>Login</a>";
				}

			?>
			
			<hr class="main">

		</div>
		

		


		
