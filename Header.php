<?php
if(isset($_POST['urlCode'])){
	$page = $_POST['page'];
	$title = $_POST['title'];
	$_SESSION['urlCode'] = $page;
	echo "<p>".$title."</p>";
	?>
	<script>startSnack();</script>
	<?php
}else{
	echo "<input class='Title' type='hidden' id='Title' name='name1'>
	<p id='test1'>hey</p>
	<input class='Url' type='hidden' id='Url' name='name2'>";
}
?>

<header>
	<nav>
    <div class="main-wrapper">
      <div class="nav-login">
	<?php
			if(isset($_SESSION['id'])){
				echo "<form method='POST' action='includes/logout.inc.php'>
				<button class='LoginB' type='submit' name='logoutSubmit'>Sign out</button>
				</form>";
				echo "<form method='POST' action='Mypage.php'>
				<button class='LoginB' type='submit' name='Mypage'>My page</button>
				</form>";
			}else {
	?>
			<button class="LoginB" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign up</button>
			<button class="LoginB" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<?php } ?>


      </div>
    </div>
  </nav>
</header>