<?php 
	include('db_util.php');
	$db = dbconnect();
	session_start();

	$user_check = $_SESSION['login_user'];

	echo $user_check;

	$session_sql = "SELECT username FROM users WHERE username='$user_check'";

	echo $session_sql;
	if(!$result = $db->query($session_sql)){
		die('There was an error running the query [' . $db->error . ']');
	}

	if($result->num_rows == 1){
		while($row = $result->fetch_assoc()){
			$login_session = $row['username'];
		}
	}

	if(!isset($login_session)){
		header("Location: index.php");
	}
?>