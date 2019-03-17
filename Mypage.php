<?php
session_start();
include 'includes/dbh.inc.php';
include 'includes/commentsProfile.inc.php';



if(isset($_POST['ajax']) && isset($_POST['follow'])){
	$id = $_SESSION['id'];
	$follows = array();

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
		array_push($follows, $row['follow']);
	}
	if(!empty($follows)){
	$followsehe = '('.implode(',', $follows) .')';
	$sql = "SELECT * FROM comments WHERE creator IN".$followsehe."ORDER BY id DESC LIMIT 20";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()){
	echo "<div class='comment-box'>";
	echo "<p id='date'>".$row['created']."</p>";
	echo $row['title']."<br>";
	echo "<p id='name'>".$row['fullname']."</p>";
	echo $row['content']."<br>";
	echo "<a class='link' href='".$row['url']."' target='blank'>".$row['url']."</a><br>";
	echo "<form class='edit-form' method='POST' action='index.php'>
	<input type='hidden' name='page' value='".$row['urlCode']."'>
	<input type='hidden' name='title' value='".$row['title']."'>
	<button name='urlCode'> Go to</button>
	</form>";
	echo "</div>";
			}
		}else{
			echo "<h2>You dont follow anyone<h2>";
		}
		exit;
	}
}

if(isset($_POST['ajax']) && isset($_POST['replies'])){
	$id = $_SESSION['id'];

	$sql = "SELECT * FROM comments WHERE creator=? AND parent IS NOT NULL ORDER BY id DESC";
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
	echo "<div class='comment-box'>";
	echo "<p id='date'>".$row['created']."</p>";
	echo $row['title']."<br>";
	echo "<p id='name'>".$row['fullname']."</p>";	
	echo $row['content']."<br>";
	echo "<a class='link' href='".$row['url']."' target='blank'>".$row['url']."</a><br>";
	echo "<form class='edit-form' method='POST' action='index.php'>
	<input type='hidden' name='page' value='".$row['urlCode']."'>
	<input type='hidden' name='title' value='".$row['title']."'>
	<button name='urlCode'> Go to</button>
	</form>";
	echo "</div>";
}
	exit;
	}
}

function Back(){
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="css/CommentStyler.css">
	<link rel="stylesheet" type="text/css" href="css/styleMypage.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title></title>
	<script>

	function Replies(Id1, Id2){

		$("#comments").load("Mypage.php", {
		  	ajax: 1,
		  	replies: 1
		  });

		document.getElementById(Id1).classList.add('active');
		document.getElementById(Id2).classList.remove('active');
		}

		
		function Follow(Id1, Id2){

		  $("#comments").load("Mypage.php", {
		  	ajax: 1,
		  	follow: 1
		  });

		  document.getElementById(Id1).classList.add('active');
		document.getElementById(Id2).classList.remove('active');
		}


	</script>
</head>
<body>
<?php
if(isset($_SESSION['id'])){
echo "<form action='index.php'>
	<button id='back' type='submit'>Back</button>
	</form><br><br>";
?>

<script>
	Follow('Followed', 'Replies');
</script>
<div class="Swag">
<ul>
  <li onclick="Follow('Followed', 'Replies')"><a class="active" id="Followed" class="active">Followed</a></li>
  <li onclick="Replies('Replies', 'Followed')"><a id="Replies">Replies</a></li>
</ul>
</div>

<div id="comments"></div>

<?php
}else {

?>
	<div class="header">
  
  <div class="header-right">
	<button class="LoginA" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
    <button class="LoginA" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign up</button>
  </div>
</div>

<div style="padding-left:20px">
  
  <p>Some content..</p>
</div>


   <?php      
}
include 'Modal.php';
?>

</body>
</html>