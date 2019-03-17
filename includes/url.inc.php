<?php

session_start();

	if(isset($_POST['suggestion'])){
		
		$Url = $_POST['suggestion'];
		$_SESSION['Url'] = $Url;
		echo $Url;	
			}
		
