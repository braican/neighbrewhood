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

		$brewery_name = $db->real_escape_string($brewery_name);
		$brewery_address = $db->real_escape_string($brewery_address);
		$brewery_city = $db->real_escape_string($brewery_city);
		$brewery_state = $db->real_escape_string($brewery_state);
		$brewery_zip = $db->real_escape_string($brewery_zip);
		$brewery_website = $db->real_escape_string($brewery_website);
		$ba_lnk = $db->real_escape_string($ba_lnk);

		$geocode_addr = "$brewery_address $brewery_city $brewery_state $brewery_zip";
		$full_address = str_replace(" ", "+", urlencode($geocode_addr));
		$geocoded = geoCode($full_address);

		if($db->connect_errno){
			die("There was a problem connecting to the database");
		}

		// add the new project to the project database
		$sql =	"INSERT INTO brewery_list(name, address, city, state, zip, lat, lng, brewers_website, ba_link) " .
			  	"VALUES (
			  		'$brewery_name',
			  		'$brewery_address',
			  		'$brewery_city',
			  		'$brewery_state',
			  		'$brewery_zip',
			  		'" . $geocoded['lat'] . "',
			  		'" . $geocoded['lng'] . "',
			  		'$brewery_website',
			  		'$ba_lnk')";

		if(!$result = $db->query($sql)){
			die('<p>There was an error running the query [' . $db->error . ']</p>');
		}
		echo "<p>$brewery_name added.</p>";

		mysqli_close($db);
	} else {
		$error_msg_array = array();
		$error_msg = "";
		if($brewery_name == "")
			$error_msg_array[] = 'brewery name';
		if($brewery_address == "")
			$error_msg_array[] = 'brewery address';
		if($brewery_state == "")
			$error_msg_array[] = 'brewery state';
		if($brewery_zip == "")
			$error_msg_array[] = 'brewery zip';

		foreach($error_msg_array as $index => $err){
			if(count($error_msg_array) == 1){
				$error_msg = $err;
			} else if($index == count($error_msg_array) - 1){
				$error_msg .= 'and ' . $err;
			} else {
				$error_msg .= $err . ', ';
			}
		}
		echo "<p>Whoops, you've gotta enter a " . $error_msg . "</p>";
	}

	function geoCode($addr){
		$details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $addr . "&sensor=false";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $details_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = json_decode(curl_exec($ch), true);

		if($response['status'] != 'OK'){
			return 'Error - unable to geocode data';
		}

		$geo = $response['results'][0]['geometry'];

		$lat = $geo['location']['lat'];
		$lng = $geo['location']['lng'];

		$array = array(
				'lat' => $lat,
				'lng' => $lng
			);
		return $array;
	}
?>