<?php require_once('util/lock.php') ?>
<html>
<head>
	<title>BreweryKeeper</title>

	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css">
	
</head>
<body>

<div class="container">
	

<!-- 	<h1>BreweryKeeper</h1>
	<h2>keep track of the breweries you've visited.</h2> -->


	<div class="login-container">
		<div class="errors"></div>

		<!-- login form box -->
		<form method="post" action="util/login.php" id="home-loginform">
		    <label for="login_input_username">Username</label>
		    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
		    <label for="login_input_password">Password</label>
		    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
		    <input type="submit"  name="login" value="Log in" />
		</form>
	</div>
	
</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/brewerykeeper.js"></script>
</body>
</html>