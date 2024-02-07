<?php
include_once'Header.php';

include_once'Profile.inc.php';
?>


<div>


	<div class="LoginB">
		<h2>Profile</h2>
		
		<hr class="RL">

		<br> 

			<div class ="bubble">

				<br>
				 <p class="searchbh">Username</p> 
				 <?php echo $_SESSION["accountun"];?><hr class="searchbh"> <br>

				 <?php if( $_SESSION["admin_perms"] === 1){
				 		echo "<p class='searchbh'>Premisions</p> Admin <hr class='searchbh'> <br>"; }
				 	else{
				 		echo "<p class='searchbh'>Premisions</p> Basic <hr class='searchbh'> <br>";	
				 	}  ?>
				 <p class="searchbh">Full name</p> 
				 <?php echo $_SESSION["accountfn"];?><hr class="searchbh">  <br>
				 <p class="searchbh">Email</p> 
				 <?php echo $_SESSION["accounte"];?><hr class="searchbh"> <br>
				 <p class="searchbh">Password</p> 
				 <?php echo $_SESSION["accountp"];?>
				 <br><br>

			</div>
		
		<br> <hr class="RL">	
		
		<br>
			
	</div>

	<div class="boioL">
		<form action="Logout.inc.php" method="post">

			<button type="submit" name="LogoutB">Logout</button>	

		</form>
	</div>

</div>

<?php
include_once'Footer.php';
?>