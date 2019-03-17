<?php
include 'dbh.inc.php';

session_start();
$urlCode = $_SESSION['Url'];
$CurrentUser = 0;
if(isset($_SESSION['id'])){
$CurrentUser = $_SESSION['id'];
}
$HasVoted;

$Comments = Array();
	$data;
	//Created a template
	$sql = "SELECT * FROM comments WHERE urlCode=?;";
	//Create a prepared statement
	$stmt = mysqli_stmt_init($conn);
	//Prepare the prepared statement
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "SQL statement failed";
	} else {
		//Bind parameters to placeholder
		mysqli_stmt_bind_param($stmt, "s", $urlCode);
		//Run parameters inside database
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		while($row = $result->fetch_assoc()){
			$CreatedbhyCurrentUser = false;
			$HasVoted = false;

			//Check if Current user has voted on comment
			$cid = $row['id'];
			//Created a template
			$sql2 = "SELECT * FROM upvotes WHERE cid=?;"; 
			//Create a prepared statement
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
			echo "SQL statement failed";
			} else {
			//Bind parameters to placeholder
			mysqli_stmt_bind_param($stmt, "i", $cid);
			//Run parameters inside database
			mysqli_stmt_execute($stmt);
			$result2 = mysqli_stmt_get_result($stmt);

				
				while($row2 = $result2->fetch_assoc()){
					if($CurrentUser == $row2['voterId']){
						$HasVoted = true;
					}
				}
			if($CurrentUser == $row['creator']){
				$CreatedbhyCurrentUser= true;
			}
				$array = Array(
			 			"id"=> $row['id'],
						"parent"=> $row['parent'],
						"created"=> $row['created'],
						"modified"=> $row['modified'],
						"content"=> $row['content'],
						"creator"=> $row['creator'],
						"fullname"=> $row['fullname'],
						"profile_picture_url"=> $row['profile_picture_url'],
						"created_by_current_user"=> $CreatedbhyCurrentUser,
						"upvote_count"=> $row['upvote_count'],
						"user_has_upvoted"=> $HasVoted,
				);
					array_push($Comments, $array);
}}}


	
	

	
	

echo json_encode($Comments);
?>