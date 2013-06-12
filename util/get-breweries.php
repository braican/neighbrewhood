<?php 

	require_once("db_util.php");
	$db = dbconnect();
	
	$sql = "SELECT * FROM `brewery_list` ORDER BY `name`";
	if(!$result = $db->query($sql)){
		die('There was an error running the query [' . $db->error . ']');
	}

	while($row = $result->fetch_assoc()){
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
		<div class="brewers-website"><a href="<?php echo $brewers_website; ?>">Brewery website</a></div>
		<div class="ba-link"><a href="<?php echo $ba_link; ?>">Beer Advocate page</a></div>
	</div>
	

<?php
	} 
	
	dbclose($result, $db);
?>