<?php

	$db_hostname="localhost"; $db_username="your username"; $db_password="your password"; $db_database="db_shop";
	if(!($dblink=mysqli_connect($db_hostname,$db_username,$db_password))){ echo("mysql connect false"); exit(); }
	mysqli_query("SET NAMES 'UTF8'");
	if (!mysqli_select_db($dblink,$db_database)){ echo("select database false"); exit(); }
?>
