<?php

include 'dbh.inc.php';

session_start();


$id = mysqli_real_escape_string($conn, $_POST["id"]);
$parent = mysqli_real_escape_string($conn, $_POST["parent"]);
$created = mysqli_real_escape_string($conn, $_POST["created"]);
$modified = mysqli_real_escape_string($conn, $_POST["modified"]);
$content = mysqli_real_escape_string($conn, $_POST["content"]);
$creator = mysqli_real_escape_string($conn, $_POST["creator"]);
$fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
$upvote_count = mysqli_real_escape_string($conn, $_POST["upvote_count"]);


if(isset($_SESSION['id'])){
$voter = $_SESSION['id'];
}

$obj = [
   	'id' => $id,
   	'parent' => $parent,
	'created' => $created,
	'modified' => $modified,
	'content' => $content,
	'creator' => $creator,
	'fullname' => $fullname,
	'created_by_current_user' => true,
	'upvote_count' => 0,
	'user has upvoted' => false
];




$sql ="UPDATE comments
SET content=?, upvote_count='0'
WHERE id=?";
//Create a prepared statement
	$stmt = mysqli_stmt_init($conn);
	//Prepare the prepared statement
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "SQL statement failed";
	} else {
		//Bind parameters to placeholder
		mysqli_stmt_bind_param($stmt, "si", $content, $id);
		//Run parameters inside database
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
}

 
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


echo json_encode($obj);