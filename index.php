<html>
<head>
	<title>BreweryKeeper</title>

	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css">
	
</head>
<body>

<div class="container">
	
	<h1>BreweryKeeper</h1>
	<h2>keep track of the breweries you've visited.</h2>
	<div class="login">
		<?php
			require_once('util/lock.php');
			
			// the user is logged in
			if ($login->isUserLoggedIn() == true) :
		?>    
			<h1>Thanks for logging in, <?php echo $_SESSION['user_name']; ?></h1>
			<a href="index.php?logout">logout</a>
		<?php // the user is not logged in ?>
		<?php else : ?>
			<!-- login form box -->
			<form method="post" action="index.php" name="loginform">
			    <label for="login_input_username">Username</label>
			    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
			    <label for="login_input_password">Password</label>
			    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
			    <input type="submit"  name="login" value="Log in" />
			</form>
		
		<?php endif; ?>

	</div>
</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/brewerykeeper.js"></script>
</body>
</html>