'<?php 

	require_once("db_util.php");
	$db = dbconnect();
	
	$sql = "SELECT * FROM `games`";
	if(!$result = $db->query($sql)){
		die('There was an error running the query [' . $db->error . ']');
	}

	while($row = $result->fetch_assoc()){
		$date = $row['date'];
		$home_away = $row['home_away'] == 1 ? 'Home' : 'Away';
		$opponent = $row['opponent'];
		$win_loss = $row['win_loss'] == 1 ? 'W' : 'L';
		$score = $row['score'];
		$sox_pitcher = $row['sox_pitcher'];
		$opposing_pitcher = $row['opposing_pitcher'];
		
?>
	<div class="row clearfix">
		<div class="date"><?php echo $date; ?></div>
		<div class="home-away"><?php echo $home_away; ?></div>
		<div class="opponent"><?php echo $opponent; ?></div>
		<div class="win-loss"><?php echo $win_loss; ?></div>
		<div class="score"><?php echo $score; ?></div>
		<div class="sox-pitcher"><?php echo $sox_pitcher; ?></div>
		<div class="opposing-pitcher"><?php echo $opposing_pitcher; ?></div>
	</div>
	

<?php
	} 
	
	dbclose($result, $db);
?>