<?php
	require_once("db_util.php");
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// the array to return
	$return_array = array();
	

	mysqli_close($db);
?>