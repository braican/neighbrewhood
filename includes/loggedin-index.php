<?php
	$sid = session_id();
	if(!$sid) {
		session_start();
	}
?>

<h3>hey, <?php echo $_SESSION['user_name']; ?></h3>
<ul class="loggedin-action-items">
	<li><a href="my-breweries.php">Go log a brewery trip</a></li>
	<li><a href="add-brewery.php">Add a brewery to our database</a></li>
	<li><a href="#" class="logout-btn">Logout</a></li>
</ul>