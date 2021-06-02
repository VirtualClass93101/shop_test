<?php

	$db_hostname="localhost"; $db_username="root"; $db_password="1234"; $db_database="db_shop_test";
	if(!($dblink=mysqli_connect($db_hostname,$db_username,$db_password))){ echo("mysql connect false"); exit(); }
	mysqli_query("SET NAMES 'UTF8'");
	if (!mysqli_select_db($dblink,$db_database)){ echo("select database false"); exit(); }
	

	// function myquery($sql=null){
	// 	global $dblink;
	// 	$res = mysqli_query($dblink,$sql);
	// 	return $res;
	// }
?>