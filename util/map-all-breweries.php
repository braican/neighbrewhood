<?php
	require_once("db_util.php");
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($db->connect_errno){
		die("There was a problem connecting to the database");
	}

	// the array to return
	$return_array = array();
	if(isset($_GET['mine'])){
		$sql =  "SELECT name, lat, lng " .
				"FROM brewery_list " .
				"INNER JOIN braican " .
				"ON brewery_list.brewery_id = braican.brewery_id";
	} else {
		$sql =  "SELECT DISTINCT name, lat, lng " .
				"FROM braican, brewery_list " .
				"WHERE brewery_list.brewery_id NOT IN " .
					"(SELECT braican.brewery_id FROM braican)";
	}

	if(!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	while($row = $result->fetch_assoc()){
		array_push($return_array, $row);
	}
	

	mysqli_close($db);

	echo json_encode($return_array);
?>