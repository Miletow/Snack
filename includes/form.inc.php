<?php

include 'dbh.inc.php';

session_start();

if(isset($_SESSION['id'])){
$id = mysqli_real_escape_string($conn, $_SESSION['id']);
$parent = mysqli_real_escape_string($conn, $_POST["parent"]);
$created = mysqli_real_escape_string($conn, $_POST["created"]);
$modified = mysqli_real_escape_string($conn, $_POST["modified"]);
$content = mysqli_real_escape_string($conn, $_POST["content"]);
$creator = mysqli_real_escape_string($conn, $_SESSION['id']);
$fullname =  mysqli_real_escape_string($conn, $_SESSION['u_uid']);
$profile_picture_url = mysqli_real_escape_string($conn, $_POST["profile_picture_url"]);
$upvote_count = mysqli_real_escape_string($conn, $_POST["upvote_count"]);
$url = mysqli_real_escape_string($conn, $_SESSION['Url']);
$urlCode = mysqli_real_escape_string($conn, $_SESSION['Url']);
$title = mysqli_real_escape_string($conn, $_SESSION['Title']);


$obj = [
   	'id' => $id,
   	'parent' => $parent,
	'created' => $created,
	'modified' => $modified,
	'content' => $content,
	'creator' => $creator,
	'fullname' => $fullname,
	'profile_picture_url' => $profile_picture_url,
	'created_by_current_user' => true,
	'upvote_count' => $upvote_count,
	'user has upvoted' => false
];


if($parent === ""){
$sql  = "INSERT INTO comments (parent, created, modified, content, fullname, profile_picture_url, upvote_count, creator, url, urlCode, title) 
 VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
 $stmt = mysqli_stmt_init($conn);
 if(!mysqli_stmt_prepare($stmt, $sql)){
 	echo "SQL input error";
 }else{
 	mysqli_stmt_bind_param($stmt, "sssssiisss", $created, $modified, $content, $fullname, $profile_picture_url, $upvote_count, $creator, $url, $urlCode, $title);
 	mysqli_stmt_execute($stmt);
 }
}else{
$sql  = "INSERT INTO comments (parent, created, modified, content, fullname, profile_picture_url, upvote_count, creator, url, urlCode, title) 
 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
 $stmt = mysqli_stmt_init($conn);
 if(!mysqli_stmt_prepare($stmt, $sql)){
 	echo "SQL input error";
 }else{
 	mysqli_stmt_bind_param($stmt, "isssssiisss", $parent, $created, $modified, $content, $fullname, $profile_picture_url, $upvote_count, $creator, $url, $urlCode, $title);
 	mysqli_stmt_execute($stmt);	
}
	}
	echo json_encode($obj);

}else{
	echo "Not Logged in!";
}
?>
