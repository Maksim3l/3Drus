<?php
session_start();

if (isset($_POST["UploadB"])){

	$ModelName = $_POST["ModelName"];

	$ModelText = $_POST["ModelText"];
	$MTags = $_POST["Modeltags"];

	$ModelDatePosted = date("Y/m/d");
	$CreatorId = $_SESSION["accountid"];

	require_once 'Database_Con.inc.php';

	require_once 'functions.inc.php';


	$MPicfileName = basename($_FILES["MPic"]["name"]);
	$ModelPic = $_FILES["MPic"]["tmp_name"];
	$MPicName = $_FILES["MPic"]["name"];

	$FilepathPic = MoveFile($conn, $ModelPic, $MPicfileName, "pictures/", $MPicName);

	$MFilefileName = basename($_FILES["MFile"]["name"]);
	$ModelFile = $_FILES["MFile"]["tmp_name"];
	$MFileName = $_FILES["MFile"]["name"];

	$FilepathFile = MoveFile($conn, $ModelFile, $MFilefileName, "models/", $MFileName);

	
	UploadModel($conn, $ModelName, $FilepathFile, $ModelText, $FilepathPic, $ModelDatePosted, $CreatorId, $MTags);

}
else{
	header("location:Search.php");
	exit();
}
/*$sql = "INSERT INTO images(file_name)VALUES(" . mysqli_escape_string(file_get_contents($MPic)) . ")";
 mysqli_query($sql); */

/*
	$targetDir = "uploads/";
	$MPicfileName = basename($_FILES["MPic"]["name"]);
	$targetFilePath = $targetDir . $fileName;

	if(move_uploaded_file($_FILES["MPic"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
    }
       */ 

	//$ModelPicName = $_FILES["MPic"]["name"];
    //$ModelPicTmpName = $_FILES["MPic"]["tmp_name"];    
    //$folder = "image/".$ModelPicName;
	/*$Picname = $_FILES["MPic"]['name'];
	$imagetype = $_FILES['pic']['type'];
	$imageerror = $_FILES['pic']['error'];
	$imagetemp = $_FILES['pic']['tmp_name'];*/

	

	
	
	//UploadModel($conn, $ModelName, $ModelFile, $ModelText, $ModelTags, $ModelPic, $ModelDatePosted, $CreatorId, $MTags);
/*


	$sql = "INSERT INTO models (ModelName, ModelPic, ModelFile, ModelDatePosted, ModelText, CreatorId, ModelTags) VALUES (?,?,?,?,?,?,?)";

	//$sql ="SELECT * FROM "

	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:Upload.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"sbbssis", $ModelName, $ModelPic, $ModelFile, $ModelDatePosted, $ModelText, $CreatorId, $MTags);
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);



	header("location:Upload.php?error=none");
	exit();
*/
		
