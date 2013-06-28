<?php
	require_once("db_util.php");
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($db->connect_errno){
		die("There was a problem connecting to the database");
	}

	// the array to return
	$return_array = array();

	$sid = session_id();
	if(!$sid) {
		session_start();
	}
	if(isset($_SESSION['user_name'])){
		$u = $_SESSION['user_name'];	
	}
	
	// if the query string 'mine' is set
	if(isset($_GET['mine'])){
		// if we're logged in and looking for the breweries you've been to
		if(isset($u)){
			$sql =  "SELECT name, lat, lng " .
					"FROM brewery_list " .
					"INNER JOIN " . $u . " " .
					"ON brewery_list.brewery_id = " . $u . ".brewery_id";
		} else { // otherwise, get outta here
			//die();
		}
	} else {
		// if we're logged in and getting the breweries you HAVEN'T been to
		if(isset($u)){
			$sql =  "SELECT DISTINCT name, lat, lng " .
					"FROM " . $u . ", brewery_list " .
					"WHERE brewery_list.brewery_id NOT IN " .
						"(SELECT " . $u . ".brewery_id FROM " . $u . ")";
		} else {
			$sql =  "SELECT name, lat, lng " .
					"FROM brewery_list";
		}
	}

	if(isset($sql)){
		if(!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while($row = $result->fetch_assoc()){
			array_push($return_array, $row);
		}	
	}
	
	mysqli_close($db);

	echo json_encode($return_array);
?>