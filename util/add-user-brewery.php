<?php
	require_once("db_util.php");

	$brewery_name = $_POST["add_brewery"];
	$user = $_POST['user'];

	if ($brewery_name!="") {
		//connect to database
		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($db->connect_errno){
			die("There was a problem connecting to the database");
		}

		// search brewery database for the brewery
		$sql = "SELECT `brewery_id` from `brewery_list` WHERE `name` = '" . $brewery_name . "'";

		// there was an error with the query
		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}

		if($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$id = $row['brewery_id'];

			// check to see if the brewery already has been entered
			$count_sql = "SELECT * FROM " . $user . " WHERE brewery_id = " . $id;
			// there was an error with the query
			if(!$count_query = $db->query($count_sql)){
				die('There was an error running the query [' . $db->error . ']');
			}

			if($count_query->num_rows != 0){
				die('You already added this brewery');
			}


			$brewery_sql = "INSERT INTO " . $user . " VALUES (" . $id . ")";

			// there was an error with the query
			if(!$brewery_result = $db->query($brewery_sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
		} else{
			echo 'Brewery not found. try entering it';
		}
		mysqli_close($db);
	} else {
		echo "Gotta put in a brewery";
	}
?>