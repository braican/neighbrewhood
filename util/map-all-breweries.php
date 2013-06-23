<?php
	require_once("db_util.php");
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($db->connect_errno){
		die("There was a problem connecting to the database");
	}

	// the array to return
	$return_array = array();

	$sql = "SELECT address, city, state FROM brewery_list";

	if(!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	while($row = $result->fetch_assoc()){
		$add = $row['address'] . ', ' . $row['city'] . ' ' . $row['state'];

		array_push($return_array, $add);
	}

	mysqli_close($db);

	echo json_encode($return_array);
?>