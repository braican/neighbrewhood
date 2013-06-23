<?php 

	require_once("db_util.php");
	
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($db->connect_errno){
		die("There was a problem connecting to the database");
	} 

	$sql = "SELECT * FROM brewery_list ORDER BY name";
	
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
		
?>
	<div class="row clearfix">
		<div class="name"><?php echo $name; ?></div>
		<div class="address"><?php echo $address; ?></div>
		<div class="city"><?php echo $city; ?></div>
		<div class="state"><?php echo $state; ?></div>
		<div class="brewers-website"><a href="<?php echo $brewers_website; ?>" target="_blank">Site</a></div>
		<!-- <div class="ba-link"><a href="<?php echo $ba_link; ?>">Beer Advocate</a></div> -->
	</div>

<?php endwhile; ?>
<?php mysqli_close($db); ?>
	
