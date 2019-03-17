<?php

include 'dbh.inc.php';

$Users = Array();
$sql = "SELECT * FROM users";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	$array = Array(
			   "id"=> $row['id'],
      			"fullname"=> $row['uid'],
      			"email"=> $row['user_email'],
     			"profile_picture_url"=> "https://app.viima.com/static/media/user_profiles/user-icon.png"
    		);
			array_push($Users, $array);
		}
    		 echo json_encode($Users);
