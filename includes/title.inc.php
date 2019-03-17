<?php

session_start();

	if(isset($_POST['suggestion'])){
		
		$Title = $_POST['suggestion'];
		$_SESSION['Title'] = $Title;
		echo $Title;	
			}
		
