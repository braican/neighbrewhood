<?php 
	require_once("db_util.php");

	$brewery_name = $_POST["brewery_name"];
	$brewery_address = $_POST["brewery_address"];
	$brewery_city = $_POST["brewery_city"];
	$brewery_state = $_POST["brewery_state"];
	$brewery_zip = $_POST["brewery_zip"];
	$brewery_website = $_POST["brewery_website"];
	$ba_lnk = $_POST["ba_link"];

	if ($brewery_name!="" && $brewery_address != "" &&
		$brewery_state != "" && $brewery_zip != "") {
		//connect to database
		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($db->connect_errno){
			die("There was a problem connecting to the database");
		}

		// add the new project to the project database
		$sql =	"INSERT INTO `brewery_list`(`name`, `address`, `city`, `state`, `zip`, `brewers_website`, `ba_link`) " .
			  	"VALUES ('" .
			  		$brewery_name . "', '" .
			  		$brewery_address . "', '" .
			  		$brewery_city . "', '" .
			  		$brewery_state . "', '" .
			  		$brewery_zip . "', '" .
			  		$brewery_website . "', '" .
			  		$ba_lnk . "')";

		echo $sql;

		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}
		echo "<p>$brewery_name added.</p>";

		mysqli_close($db);
	} else {
		echo "no dice";
	}
?>