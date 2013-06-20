<?php //require_once('lock.php'); ?>

<?php 
require_once("libraries/password_compatibility_library.php");

// include the configs / constants for the database connection
require_once("db_util.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...

$login_submit = new Login();
?>


<?php if ($login_submit->isUserLoggedIn() == true) : ?>
		<h1>Thanks for logging in, <?php echo $_SESSION['user_name']; ?></h1>
		<a href="?logout">logout</a>
<?php
	else :
		// show negative messages
		//echo 'Wrong login credentials';	
		if ($login_submit->errors) {
		    foreach ($login_submit->errors as $error) {
		        echo $error;    
		    }
		}

		// show positive messages
		if ($login_submit->messages) {
		    foreach ($login_submit->messages as $message) {
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