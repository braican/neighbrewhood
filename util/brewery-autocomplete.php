<?php
	require_once("db_util.php");
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($db->connect_errno){
		die("There was a problem connecting to the database");
	}

	$q = $db->real_escape_string($_GET["term"]);

	// the array to return
	$return_array = array();

	$sql = "SELECT name FROM brewery_list WHERE name LIKE '%$q%'";

	if(!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	while($row = $result->fetch_assoc()){
		$row_array['label'] = $row['name'];

		array_push($return_array, $row_array);
	}

	mysqli_close($db);

	echo json_encode($return_array);
?>
