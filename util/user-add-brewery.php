<?php
	require_once("db_util.php");

	$brewery_name = $_POST["add_brewery"];


	if ($brewery_name!="") {
		//connect to database
		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($db->connect_errno){
			die("There was a problem connecting to the database");
		}

		// search brewery database for the brewery
		//SELECT `brewery_id` FROM `brewery_list` WHERE `name` = 'harpoon brewery'
		$sql = "SELECT `brewery_id` from `brewery_list` WHERE `name` = '" . $brewery_name . "'";

		// add the new project to the project database
		// $sql =	"INSERT INTO `brewery_list`(`name`, `address`, `city`, `state`, `zip`, `brewers_website`, `ba_link`) " .
		// 	  	"VALUES ('" .
		// 	  		$brewery_name . "', '" .
		// 	  		$brewery_address . "', '" .
		// 	  		$brewery_city . "', '" .
		// 	  		$brewery_state . "', '" .
		// 	  		$brewery_zip . "', '" .
		// 	  		$brewery_website . "', '" .
		// 	  		$ba_lnk . "')";


		echo $sql;

		// there was an error with the query
		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}

		if($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$id = $row['brewery_id'];
			$user = $_SESSION['user_name'];
			$brewery_sql = "INSERT INTO `" . $user . "` VALUES (" . $id . ")";
		}
		// while($row = $result->fetch_assoc()) {

		// }

		mysqli_close($db);
	} else {
		echo "Gotta put in a brewery";
	}
?>