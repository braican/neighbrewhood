	<?php
	// if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
	// (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
	require_once("libraries/password_compatibility_library.php");

	// include the configs / constants for the database connection
	require_once("db_util.php");

	// load the login class
	require_once("classes/Login.php");

	// create a login object. when this object is created, it will do all login/logout stuff automatically
	// so this single line handles the entire login process. in consequence, you can simply ...
	$login = new Login();
	?>

	<?php if ($login->isUserLoggedIn() == true) : ?>
		<h1>Welcome <?php echo $_SESSION['user_name']; ?></h1>
	    <p>Go to <a href="my-breweries.php">my breweries</a></p>
	<?php else : ?>
		<?php

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

		<!-- login form box -->
		<form method="post" action="index.php" name="loginform">
		    <label for="login_input_username">Username</label>
		    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
		    <label for="login_input_password">Password</label>
		    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
		    <input type="submit"  name="login" value="Log in" />
		</form>

		<a href="register.php">Register new account</a>
		
	<?php endif; ?>