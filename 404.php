<?php

session_start();


$str = str_replace("/Snack/", "", $_SERVER['REQUEST_URI'], $count);
$_SESSION['urlCode'] = $str;


header("Location: http://snack-start.com");

?>	
