<?php
include_once'Header.php';
?>

<div>


	<div class="bigboi">
		<h2>Upload</h2>
		
		<hr class="RL">

		<br> <br>

			<div class ="bubble UBwidth">
				<br>
				<form method='GET'><br>
					Select your upload type <br> <br>
					<select class="smolsizeup" id="typeUp" name="typeUp">
						<option value="model">Model</option>		
    					<?php
    					if($_SESSION["admin_perms"] === 1){
    					echo"<option value='news'>Newsletter</option>";}
    					?>
 					</select><br> <br>
 					<?php if(!isset($_GET["typeUp"])){

						echo"  	";
					}?>
 					
 					<?php if(!isset($_GET["typeUp"])){

						echo"</div><br><br>
						
						<br></div><hr class='RL'>	";
					}?>
 					<div class ="center"><br><button class="center" type='submit' name='Continue'>Continue</button></div></form>

 					<?php
 					if(isset($_GET["typeUp"])){
 					$Uploadtype = filter_input(INPUT_GET, 'typeUp', FILTER_SANITIZE_STRING);


 					if ($Uploadtype == "model")
 					{
 						echo"<hr class='searchbh'> 
 						<form action='Uploadmodel.inc.php' method='POST' enctype='multipart/form-data'>
 							<br>
								<input class='sizeup' type='text' id='ModelName' name='ModelName' placeholder='Model name'> <br> <br>

								<label for='MFile' class='file sizeup'>
								<input type='file' id='MFile' name='MFile'  accept='.stl,.obj,.fbx,.amf,.3mf,.bae,.3ds,.igs, .iges,.stp,.ctb'>
								Add the model file</label> <br> <br>

								<textarea rows='7' cols='55' type='textarea' id='ModelText' name='ModelText' placeholder='Enter the models description'>  </textarea> <br> <br> 
				
								<input class='sizeup' type='text' id='Modeltags' name='Modeltags' placeholder='Model tags (seperate them with space)'> <br> <br>

								<label for='MPic' class='file sizeup'>
								<input type='file' id='MPic' name='MPic' accept='image/*,.jpg,.jpeg,.png,.gif'>
								Add a picture</label> <br> 
						
		
							<br> <hr class='RL'>	
					
							</div> 
							<div class='boioL'>

								<br><button type='submit' name='UploadB'>Upload</button><br><br>

							</div>  			

						</form> </div></div>";}
						else if ($Uploadtype == "news")
						{
 						echo"<hr class='searchbh'> 
 						<form action='Uploadnews.inc.php' method='POST'>
 							<br>
								<input class='sizeup' type='text' id='NewsTitle' name='NewsTitle' placeholder='News title'> <br> <br>

								<input class='captionsize' type='text' id='NewsCaption' name='NewsCaption' placeholder='News caption'> <br> <br>

								<textarea rows='7' cols='55' type='textarea' id='NewsText' name='NewsText' placeholder='Enter the models description'>  </textarea> <br> 
						
		
							<br> <hr class='RL'>	
		
							<br>
							</div> 
							<div class='boioL'>
								<br><button type='submit' name='UploadB'>Upload</button><br><br>
							</div>  			

						</form>

						</div></div>
						";}
					}



					
 					?>
					


				
				
</div>
	  	



<?php
include_once'Footer.php';
?>