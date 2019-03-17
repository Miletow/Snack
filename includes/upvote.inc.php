<?php

include 'dbh.inc.php';


session_start();


$id = $_POST["id"];
$parent = $_POST["parent"];
$created = $_POST["created"];
$modified = $_POST["modified"];
$content = $_POST["content"];
$creator = $_POST["creator"];
$fullname = $_POST["fullname"];
$upvote_count = $_POST["upvote_count"];
$user_has_upvoted = $_POST["user_has_upvoted"];


if(isset($_SESSION['id'])){
$voter = $_SESSION['id'];
}




$sql ="UPDATE comments
SET upvote_count=?
WHERE id=?";
$stmt = mysqli_stmt_init($conn);
		//Prepare the prepared statement
		if(!mysqli_stmt_prepare($stmt, $sql)){
			echo "SQL statement failed";
		} else {
			//Bind parameters to placeholder
			mysqli_stmt_bind_param($stmt, "ii", $upvote_count, $id);
			//Run parameters inside database
			mysqli_stmt_execute($stmt);
	}
 
$sql = "INSERT INTO upvotes (cid, voterid) VALUES (?, ?)";
$stmt = mysqli_stmt_init($conn);
		//Prepare the prepared statement
		if(!mysqli_stmt_prepare($stmt, $sql)){
			echo "SQL statement failed";
		} else {
			//Bind parameters to placeholder
			mysqli_stmt_bind_param($stmt, "ii", $id, $voter);
			//Run parameters inside database
			mysqli_stmt_execute($stmt);		
	}