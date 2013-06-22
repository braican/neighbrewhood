<?php
	$loggedin = isset($_GET['logged']) ? true : false;

	if(isset($login)){
		if($login->isUserLoggedIn() == true){
			$loggedin = true;
		}
	}

	$sid = session_id();
	if(!$sid) {
		session_start();
	}	
?>

	<?php if($loggedin == true) : ?>
		<div class="login-prompt">hey <?php echo $_SESSION['user_name']; ?></div>
		<div class="account-links">
			<a href="#" class="logout-btn">Logout</a>
			<a href="add-brewery.php">Add a Brewery</a>
			<a href="#" class="close-account-links">Close</a>
		</div>
	<?php else : ?>
		<div class="login-prompt">LOGIN</div>
		<div class="account-links">
			<!-- login form box -->
			<form method="post" action="util/login.php" id="loginform">
			    <input id="login_input_username" class="login_input" type="text" name="user_name" required placeholder="username"/>
			    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required placeholder="password" />
			    <input type="submit"  name="login" value="Log in" />
			    <span class="register-slideout"><a href="#">or register</a></span>
			</form>
			<div class="error-messages"></div>
		</div>
	<?php endif; ?>