<?php 
	
	$sid = session_id();
	if(!$sid) {
		session_start();
	}
	$u = $_SESSION['user_name'];
	
	require_once("db_util.php");
	
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($db->connect_errno){
		die("There was a problem connecting to the database");
	}

	$sql =	"SELECT b.name, b.city, b.state " .
			"FROM brewery_list b," . $u . " " .
			"WHERE b.brewery_id = " . $u . ".brewery_id";

	// echo $sql;
	if(!$result = $db->query($sql)){
		die('There was an error running the query [' . $db->error . ']');
	}

	while($row = $result->fetch_assoc()) :
		$name = $row['name'];
		$city = $row['city'];
		$state = $row['state'];
?>
	<div class="row clearfix">
		<div class="name"><?php echo $name; ?></div>
		<div class="city"><?php echo $city; ?></div>
		<div class="state"><?php echo $state; ?></div>
	</div>

<?php endwhile; ?>
<?php mysqli_close($db); ?>