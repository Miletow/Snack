<?php

include 'dbh.inc.php';


session_start();


if(isset($_SESSION['id'])){
$voter = $_SESSION['id'];

$id = $_POST["id"];

$creator = $_POST["creator"];




$sql = "DELETE FROM upvotes WHERE cid=?";
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
}

$sql = "DELETE FROM comments WHERE id=?";
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
	
	echo $creator;
}
}