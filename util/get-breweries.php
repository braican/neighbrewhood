<?php 

	require_once("db_util.php");
	
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($db->connect_errno){
		die("There was a problem connecting to the database");
	} 

	if(isset($_GET['state'])){
		$filter_state = $_GET['state'];	
	}

	if(isset($_GET['city'])){
		$filter_city = $_GET['city'];	
	}
	
	if(isset($filter_state) && $filter_state != '' && isset($filter_city) && $filter_city != ''){
		$sql = "SELECT name, address, city, state, lat, lng, brewers_website, ba_link FROM brewery_list WHERE state = '$filter_state' AND city = '$filter_city' ORDER BY name";	
	} else if(isset($filter_state) && $filter_state != ''){
		$sql = "SELECT name, address, city, state, lat, lng, brewers_website, ba_link FROM brewery_list WHERE state = '$filter_state' ORDER BY name";	
	} else if(isset($filter_city) && $filter_city != ''){
		$sql = "SELECT name, address, city, state, lat, lng, brewers_website, ba_link FROM brewery_list WHERE city = '$filter_city' ORDER BY name";	
	} else{
		$sql = "SELECT name, address, city, state, lat, lng, brewers_website, ba_link FROM brewery_list ORDER BY name";	
	}
	
	
	if(!$result = $db->query($sql)){
		die('There was an error running the query [' . $db->error . ']');
	} else {
?>
	<div class="row header clearfix">
		<div class="name">Brewery</div>
		<div class="address">Address</div>
		<div class="city">City</div>
		<div class="state">State</div>
		<div class="brewers-website">Website</div>
		<!-- <div class="ba-link"><a href="<?php echo $ba_link; ?>">Beer Advocate</a></div> -->
	</div>
<?php
	}

	while($row = $result->fetch_assoc()) :
		$name = $row['name'];
		$address = $row['address'];
		$city = $row['city'];
		$state = $row['state'];
		$brewers_website = $row['brewers_website'];
		$ba_link = $row['ba_link'];

		$lat = $row['lat'];
		$lng = $row['lng'];
		
?>
	<div class="row clearfix" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>">
		<div class="name"><?php echo $name; ?></div>
		<div class="address"><?php echo $address; ?></div>
		<div class="city"><?php echo $city; ?></div>
		<div class="state"><?php echo $state; ?></div>
		<div class="brewers-website"><a href="<?php echo $brewers_website; ?>" target="_blank">Site</a></div>
		<!-- <div class="ba-link"><a href="<?php echo $ba_link; ?>">Beer Advocate</a></div> -->
	</div>

<?php endwhile; ?>
<?php mysqli_close($db); ?>
	
