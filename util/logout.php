<?php    
	$sid = session_id();
	if(!$sid) {
		session_start();
	}
	$_SESSION = array();
    session_destroy();
?>