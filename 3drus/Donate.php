<?php
include_once'Header.php';
?>

<div>


	<div class="bigboi">
		<h2>Donate</h2>
		
		<hr class="RL">

		<br> <br> <br>

			<div class ="bubble UBwidth">
				
					<form action="Donate.inc.php" method="POST">

					<br><input class="sizeup" type="text" id="DonationTitle" name="DonationTitle" autocomplete="on"  placeholder="Donation title"> <br> <br>

					<textarea rows='7' cols='55' type='textarea' id='DonationText' name='DonationText' placeholder='Enter the models description'>  </textarea> <br> <br>  
	
					<input type="number" id="DonationAmount" name="DonationAmount" min="1" max="100" step="1" value="10"> <br> <br>

					<select id="currency" name="currency">
    					<option value="eur">(€) EUR</option>
    					<option value="usd">(US$) USD</option>
    					<option value="jpy">(円/¥) JPY</option>
    					<option value="gbp">(£) GBP</option>
    					<option value="aud">(A$) AUD</option>
    					<option value="cad">(C$) CAD</option>
    					<option value="chf">(CHF) CHF</option>
    					<option value="cny">(元/¥) CNY</option>
    					<option value="hkd">(HK$) HKD</option>
    					<option value="nzd">(NZ$) NZD</option>
 					</select><br> <br>
			</div>
			<br><br><br>
 		<hr class="RL">	

			
	</div>

	<div class="boioL">
		<br><button type="submit" name="DonateB">Donate</button>
	</div>

	</form>

</div>
	  	



<?php
include_once'Footer.php';
?>