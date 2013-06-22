<?php
require_once("libraries/password_compatibility_library.php");

// include the configs / constants for the database connection
require_once("db_util.php");

// load the registration class
require_once("classes/Registration.php");

// create the registration object. when this object is created, it will do all registration stuff automaticly
// so this single line handles the entire registration process.
$registration = new Registration();
?>

<?php if ($registration->errors) : ?>
	<h3 class="try-again">Try again,</h3>
	<div class="reg-errors">
<?php
    foreach ($registration->errors as $error) {
        echo '<p>' . $error . '</p>';
    }
?>
	</div><!-- .reg-errors -->
	<form method="post" name="registerform" id="registerform">   
	    <label for="login_input_username">Desired username</label>  
	    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required  />
	  
	    <label for="login_input_email">email</label>    
	    <input id="login_input_email" class="login_input" type="email" name="user_email" required />        
	    
	    <label for="login_input_password_new">Password (min. 6 characters)</label>
	    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />  
	    
	    <label for="login_input_password_repeat">Repeat password</label>
	    <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />

	    <input type="submit"  name="register" value="Register" />
    
	</form>
<?php else : ?>

<h3>Thanks for registering.</h3>
<?php
// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
        echo $message;
    }
}
?>
<p class="slidedown-trigger">Login</p>
	<div class="drawer">
		<!-- login form box -->
		<form method="post" action="util/login.php" id="loginform">
		    <input class="login_input" type="text" name="user_name" required placeholder="username"/>
		    <input class="login_input" type="password" name="user_password" autocomplete="off" required placeholder="password" />
		    <input type="submit"  name="login" value="Log in" />
		</form>
	</div><!-- .drawer -->
</div><!-- .slidedown -->

<?php endif; ?>