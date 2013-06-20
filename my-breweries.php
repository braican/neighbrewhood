<?php require_once('util/lock.php'); ?>

<?php include('includes/header.html'); ?>

	<h1>BreweryKeeper</h1>

	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="my-breweries.php">My Breweries</a></li>
		</ul>
	</nav>

	<?php
		if ($login->isUserLoggedIn() == true) :
			echo 'loggedIn!';
	?>
		<h1>welcome <?php echo $_SESSION['user_name']; ?></h1>
		<p><a href="?logout">Logout</a></p>
		<h2>the <a href="brewery-list.php">list of breweries</a>.</h2>
		<div class="brewery-list">
			
		</div>

		<div class="success-text"></div>
	<?php
		else :
			echo 'not logged in';
			// show negative messages
			if ($login->errors) {
			    foreach ($login->errors as $error) {
			        echo $error;    
			    }
			}

			// show positive messages
			if ($login->messages) {
			    foreach ($login->messages as $message) {
			        echo $message;
			    }
			}
	?>

	<div class="errors"></div>
	
	<!-- login form box -->
	<form method="post" action="util/login.php" id="loginform">
	    <label for="login_input_username">Username</label>
	    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
	    <label for="login_input_password">Password</label>
	    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
	    <input type="submit"  name="login" value="Log in" />
	</form>
	
		
	<?php endif; ?>

<?php include('includes/footer.html'); ?>