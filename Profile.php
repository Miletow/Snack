<!DOCTYPE html>
<html>
<?php
session_start();
include 'includes/commentsProfile.inc.php';
include 'includes/dbh.inc.php';


if(isset($_POST['data'])){
$_SESSION['Visited_Profile'] = $_POST['data'];
$_SESSION['name'] = $_POST['name'];
}
 
?>

<head>


	<title></title>
	<link rel="stylesheet" type="text/css" href="css/CommentStyler.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>

        //  Get followState
		var followState;
		$.post("includes/follow.inc.php",
        {
          data: 'followState'
        }, function(data){
        	followState = data;
        	if(data == "false"){
        	$("#tibia").html('Follow');
        	}else {
        		$("#tibia").html('Unfollow');
        	}
        });

	</script>
</head>
<body>

	<script>

		//	Follow
		$(document).ready(function(){
	$("#tibia").click(function(){

		$.post("includes/follow.inc.php",
        {
      		state: followState
        }, function(data){
        	followState = data;
        	if(data == "false"){
        	$("#tibia").html('Follow');
        	}else {
        		$("#tibia").html('Unfollow');
        	}
        });
});
});

	</script>
    
<?php

echo "<form action='index.php'>
    <button id='back' type='submit'>Back</button>
    </form>";


    if(isset($_SESSION['id']) && $_SESSION['Visited_Profile']!= $_SESSION['id']){
	echo "<div  class='tibia'>
	<button id='tibia'></button>
	</div>";
}
echo "<h1>".$_SESSION['name']."'s messages</h1>";
getComments($conn);

?>

</body>
</html>