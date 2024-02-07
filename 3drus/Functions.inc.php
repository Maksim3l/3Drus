<?php


function emptyInputSignup($AccountName, $AccountEmail, $AccountUsername, $AccountPwd, $AccountPwdRe){
	$results;

	if(empty($AccountName) || empty($AccountEmail) || empty($AccountUsername) || empty($AccountPwd) || empty($AccountPwdRe)){
		$results = true;
	}
	else{
		$results = false;
	}
	return $results;
}

function InvalidAcName($AccountUsername){
	$results;

	if(!preg_match("/^[a-zA-Z0-9]*$/", $AccountUsername)){
		$results = true;
	}
	else{
		$results = false;
	}
	return $results;
}

function InvalidEmail($AccountEmail){
	$results;

	if(!filter_var($AccountEmail, FILTER_VALIDATE_EMAIL)){
		$results = true;
	}
	else{
		$results = false;
	}
	return $results;
}


	function PwdCheck($AccountPwd, $AccountPwdRe){
	$results;

	if($AccountPwd !== $AccountPwdRe){
		$results = true;
	}
	else{
		$results = false;
	}
	return $results;
}

function AccountTaken($conn, $AccountUsername, $AccountEmail){
	$sql = "SELECT * FROM accounts WHERE AccountUsername = ? OR AccountEmail = ?;";

	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:Register.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"ss", $AccountUsername, $AccountEmail);
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);

	if($row = mysqli_fetch_assoc($resultData)){
		return $row;
	}
	else{
		$results = false;
		return $results;
	}
	mysqli_stmt_close($stmt);
}

function CreateUser($conn, $AccountName, $AccountEmail, $AccountUsername, $AccountPwd){
	$sql = "INSERT INTO accounts (AccountName, AccountEmail, AccountUsername, AccountPwd) VALUES (?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:Register.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($AccountPwd, PASSWORD_DEFAULT);


	mysqli_stmt_bind_param($stmt,"ssss", $AccountName, $AccountEmail, $AccountUsername, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location:Register.php?error=none");
	exit();

}

function emptyInputLogin($AccountUsername, $AccountPwd){
	$results;

	if(empty($AccountUsername) || empty($AccountPwd)){
		$results = true;
	}
	else{
		$results = false;
	}
	return $results;
}

function LoginAccount($conn, $AccountUsername, $AccountPwd){
	$uidExists = AccountTaken($conn, $AccountUsername, $AccountUsername);

	if ($uidExists === false){
	header("location:Login.php?error=wrongLogin");
	exit();
	}

	$hashedPwd = $uidExists["AccountPwd"];
	$PwdCheck = password_verify($AccountPwd, $hashedPwd);

	if ($PwdCheck === false){
	header("location:Login.php?error=wrongPassword");
	exit();
	}
	elseif ($PwdCheck === true) {
	session_start();
	$_SESSION["accountid"] = $uidExists["AccountId"];
	$_SESSION["accountun"] = $uidExists["AccountUsername"];
	$_SESSION["accountp"] = $AccountPwd;
	$_SESSION["admin_perms"] = $uidExists["Admin"];

	header("location:Home.php");
	exit();
	}
}

function GetInfo($conn, $AccountId){
	$sql = "SELECT AccountName,AccountEmail,AccountPwd,Admin FROM accounts WHERE AccountId = ?;";

	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:Register.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"i", $AccountId);
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);


	if($row = mysqli_fetch_assoc($resultData)){
        $_SESSION["accountfn"] = $row["AccountName"];
		$_SESSION["accounte"] = $row["AccountEmail"];
		$_SESSION["admin_perms"] = $row["Admin"];
		return $row;

	}
	else{
		$results = false;
		return $results;
	}

	mysqli_stmt_close($stmt);
}

function emptyInputUpload($ModelName, $ModelFile){
	$results;

	if(empty($ModelName) || empty($_FILES($ModelFile))){
		$results = true;
	}
	else{
		$results = false;
	}
	return $results;
}

function UploadModel($conn, $ModelName, $ModelFile, $ModelText, $ModelPic, $ModelDatePosted, $CreatorId, $MTags){

	$sql = "INSERT INTO models (ModelName, ModelPic, ModelFile, ModelDatePosted, ModelText, CreatorId) VALUES (?,?,?,?,?,?);";

	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:Upload.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"sssssi", $ModelName, $ModelPic, $ModelFile, $ModelDatePosted, $ModelText, $CreatorId);
	
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);

	$tags = explode(' ', $MTags);

	foreach ($tags as $tag) {
		InsertTag($conn, $tag, $ModelName);
	}
	

	header("location:Upload.php?error=none");
	exit();

}

function InsertTag($conn, $tag, $ModelName){

	$ModelId = GetModelId($conn, $ModelName);

	$sql = "INSERT INTO model_tags (ModelHeldId, Tag) VALUES (?,?);";

	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:Upload.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "is", $ModelId, $tag);
	
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);


}

function GetModelId($conn, $ModelName){

	$sql = "SELECT ModelId, ModelName FROM models WHERE ModelName =' ". $ModelName ."';";

	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:Upload.php?error=stmtfailed");
		exit();
	}
	
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);

	while ($row = mysqli_fetch_assoc($resultData)){
		return $row;
	}
}



function MoveFile($conn,$MFileNameTmp,$MFileBaseName, $targetDir, $MPicName){

		$targetFilePath = $targetDir . $MPicName;

		move_uploaded_file($MFileNameTmp, $targetFilePath);
	            	
	   return $targetFilePath;

}



function Donate($conn, $DonerId, $DonationTitle, $DonationText, $DonationAmount, $Currency){

	$sql = "INSERT INTO donations (DonorId, DonationTitle, DonationText, DonationAmount, CurrencyType) VALUES (?,?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:Donate.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"issis", $DonerId, $DonationTitle, $DonationText, $DonationAmount, $Currency);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location:Donate.php?error=none");
	exit();

}
function UploadNews($conn, $AuthorId, $NewsTitle, $NewsCaption, $NewsText, $NewsDate){

	$sql = "INSERT INTO news (AuthorId, NewsTitle, NewsCaption, NewsText, NewDate) VALUES (?,?,?,?,?);";

	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:Upload.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"issss", $AuthorId, $NewsTitle, $NewsCaption, $NewsText, $NewsDate);
	
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);

	$tags = explode(' ', $MTags);
	

	header("location:Upload.php?error=none");
	exit();

}

function DisplayNews($conn){


$sql = "SELECT AccountId, AccountUsername, AuthorId, NewsTitle, NewsCaption, NewsText, NewDate FROM accounts,news WHERE AccountId = AuthorId ORDER BY NewDate DESC";
$result = mysqli_query($conn, $sql); // First parameter is just return of "mysqli_connect()" function



echo "<div class = 'news'>";
echo "<br>";
while ($row = mysqli_fetch_assoc($result)) { 

	$previewtext = substr($row['NewsText'],0,500).'...';	
   
    echo "<div class = 'newsletter'>";
    	echo "<div class='row'>";
    		echo "<div class = 'newstitle'>";
        		echo $row['NewsTitle'];
        	echo "</div>";	

        	echo "<div class = 'newsdate'>";
        		echo "Date posted: ".$row['NewDate'];
        	echo "</div>";	
        echo "</div>";	

        echo"<hr class='newshl'>";

		echo "<div class='row'>";
        	echo "<div class = 'newscaption'>";
        		echo $row['NewsCaption'];
       		echo "</div>";	

        	echo "<div class = 'newsauthor'>";
        		echo "Written by: ".$row['AccountUsername'];
        	echo "</div>";	
        echo "</div>";

        echo"<div class = 'previewnews'>";
        	echo $previewtext;
        echo"</div>";	

    echo "</div>";
    
 echo "<br>";
}
echo "</div>";

}

function DisplayModels($conn){


$sql = "SELECT AccountId, AccountUsername, CreatorId, ModelName, ModelPic, ModelFile, ModelDatePosted, ModelText, Downloads FROM accounts, models WHERE AccountId = CreatorId ORDER BY ModelDatePosted DESC";
$result = mysqli_query($conn, $sql); // First parameter is just return of "mysqli_connect()" function



echo "<div class = 'models'>";

while ($row = mysqli_fetch_assoc($result)) { 

	$previewtext =strlen($row['ModelText']) > 50 ? substr($row['ModelText'],0,150)."..." : $row['ModelText'];
   
    echo "<div class = 'modelcontainer'>";

    	echo "<div class='bubble modeltexties'>";
    		echo "<div class = 'modelname'>";
        		echo $row['ModelName'];
        	echo "</div>";	

        	echo"<hr class='mol'>";

        	echo "<div class = ''>";
        		echo "Made by: ".$row['AccountUsername'];
        	echo "</div>";	

        	echo "<div class = 'modeldate'>";
        		echo "Date posted: ".$row['ModelDatePosted'];
        	echo "</div>";	

        	echo "<div class = 'modeltext'>";	
        		echo $previewtext;
        		if (strlen($previewtext) < 75){
        			echo"<br><br>";
        		}
        	echo "</div>";	

        	echo"<hr class='mol'>";

        	echo "<div class = 'download'>";
        		//echo "Number of downloads: ".$row['Downloads']."<br>";
        		echo "<a download href='http://localhost/3drus/".$row['ModelFile']."'> Download model </a>";
        	echo "</div>";

        	echo"<hr class='mol'>";

        echo "</div>";	

        

		echo "<div class='modelpic'>";
        	echo "<div class = ''>";
        		echo "<img class='box' src='http://localhost/3drus/".$row['ModelPic']."'>";
       		echo "</div>";	

    
        echo "</div>";

  

    echo "</div>";
    
 echo "<br>";
}
echo "</div>";

}

/*<div class="holder">
					
					<div class="Textdisplayed">
						<div class="ModelTitle"> eetet</div>
						<hr class="ML">
						<div class="Modeltext">etetete</div>
						<hr class="ML">
						<div class="tags"></div>
					</div>

					<div class="picturedisplayed">
						<img class="box" src="pictures\indteeereex.jpg">
					</div>

			</div>	*/






