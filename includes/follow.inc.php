<?php

include 'dbh.inc.php';

session_start();
$id = $_SESSION['id'];
$profile = $_SESSION['Visited_Profile'];
$follow;


	// Get follow state
if(isset($_POST['data'])){
$id = $_SESSION['id'];
$follow = false;
$sql = "SELECT * FROM follow WHERE uid=?";
//Create a prepared statement
	$stmt = mysqli_stmt_init($conn);
	//Prepare the prepared statement
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "SQL statement failed";
	} else {
		//Bind parameters to placeholder
		mysqli_stmt_bind_param($stmt, "i", $id);
		//Run parameters inside database
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	while($row = $result->fetch_assoc()){
		if($row['follow'] == $profile){
			$follow = true;
		}
	}
	}
}

	if($follow){
		echo "true";

	}else{
	echo "false";

}

	//Follow button clicked

if(isset($_POST['state'])){

$state = $_POST['state'];

if($state == "true"){

	$sql = "DELETE FROM follow WHERE uid=? AND follow=?";
	//Create a prepared statement
	$stmt = mysqli_stmt_init($conn);
	//Prepare the prepared statement
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "SQL statement failed";
	} else {
		//Bind parameters to placeholder
		mysqli_stmt_bind_param($stmt, "ii", $id, $profile);
		//Run parameters inside database
		mysqli_stmt_execute($stmt);
	echo "false";
}
}else{

	$sql = "INSERT INTO follow (uid, follow) VALUES (?, ?)";
	//Create a prepared statement
	$stmt = mysqli_stmt_init($conn);
	//Prepare the prepared statement
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "SQL statement failed";
	} else {
		//Bind parameters to placeholder
		mysqli_stmt_bind_param($stmt, "ii", $id, $profile);
		//Run parameters inside database
		mysqli_stmt_execute($stmt);

	echo "true";
}

	}
}



