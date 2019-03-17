<?php

include 'dbh.inc.php';

session_start();
$id = $_SESSION['id'];

$follows = array();

	$sql = "SELECT * FROM follow WHERE uid='$id'";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		array_push($follows, $row['follow']);
	}

echo json_encode($follows);