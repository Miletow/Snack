
<?php
function getComments($conn){
	
	$profile = $_SESSION['Visited_Profile'];
	$sql = "SELECT * FROM comments WHERE creator='$profile' ORDER BY id DESC";
	$result = $conn->query($sql);
	$Tibia = "";
	while($row = $result->fetch_assoc()){
	echo "<div class='comment-box'>";
	echo "<p id='date'>".$row['created']."</p>";
	echo $row['title']."<br>";
	echo $row['content']."<br>";
	echo "<a class='link' href='".$row['url']."' target='blank'>".$row['url']."</a><br>";
	echo "<form class='edit-form' method='POST' action='index.php'>
	<input type='hidden' name='page' value='".$row['url']."'>
	<input type='hidden' name='title' value='".$row['title']."'>
	<button name='urlCode'> Go to</button>
	</form>";
	echo "</div>";
		}
	}


?>