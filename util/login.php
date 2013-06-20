<?php require_once('lock.php'); ?>
<?php if ($login->isUserLoggedIn() == true) : ?>
		<h1>Thanks for logging in, <?php echo $_SESSION['user_name']; ?></h1>
		<a href="?logout">logout</a>
<?php
	else :
		// show negative messages
		echo 'Wrong login credentials';
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
	<form method="post" action="util/login.php" id="home-loginform">
	    <label for="login_input_username">Username</label>
	    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
	    <label for="login_input_password">Password</label>
	    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
	    <input type="submit"  name="login" value="Log in" />
	</form>	
	
	<?php endif; ?>