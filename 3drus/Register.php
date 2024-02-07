<?php
include_once'Header.php';
?>


	
		
		
		<div class="bubble LoginB">
			<h2>Register</h2>

			<form action="Register.inc.php" method="post">
			<hr class="RL"> <br>

			


			<div class ="bubble">
				<br>
			
				<input type="text" id="fname" name="fname" autocomplete="on"  placeholder="Full name"> <br> <br> 

				<input type="text" id="username" name="username" autocomplete="on"  placeholder="Username"> <br> <br> 

				<input type="text" id="email" name="email" autocomplete="on"  placeholder="Email"> <br> <br> 

				<input type="password" id="password" name="password" autocomplete="on"  placeholder="Password"> <br>  <br> 

				<input type="password" id="repassword" name="repassword" autocomplete="on"  placeholder="Repeat password"> <br>  <br> 

				
			</div>

			<br>
				<hr class="RL">

			<?php
				if (isset($_GET["error"])){
					if($_GET["error"] == "emptyinput"){
						echo "<p>Please fill in the empty fields.</p>";
					}
					elseif ($_GET["error"] == "invalidaccountname"){
						echo "<p>This username is invalid.</p>";
					}
					elseif ($_GET["error"] == "invalidemail"){
						echo "<p>This email is invalid.</p>";
					}
					elseif ($_GET["error"] == "passworddontmatch"){
						echo "<p>The passwords do not match.</p>";
					}
					elseif ($_GET["error"]=="usernametaken"){
						echo "<p>This username is already taken.</p>";
					}
					elseif ($_GET["error"]=="stmtfailed"){
						echo "<p>Something went wrong, please try again.</p>";
					}
					elseif ($_GET["error"]=="none"){
						echo "<p>Account register successful.</p>";
					}

				}

				?>

			<div class="boioL">
					<?php $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
					$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					if ($url =="http://localhost/3drus/Register.php"){echo"<br>";}?>
					<button id="return" onclick="location.href = 'http://localhost/3drus/Login.php';">Return</button>
					<button type="submit" id="submit" name="submitF">Finish</button>
				
			</div>

			</form>
			
		</div>

<?php
include_once'Footer.php';
?>