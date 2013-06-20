<?php require_once('util/lock.php'); ?>

<?php include('includes/header.html'); ?>

	<!-- <h1>BreweryKeeper</h1> -->

<?php include('includes/nav.html'); ?>

	<?php if ($login->isUserLoggedIn() == true) : ?>
		
		<h1>welcome <?php echo $_SESSION['user_name']; ?></h1>
		<p><a href="?logout">Logout</a></p>
		<h2>the <a href="brewery-list.php">list of breweries</a>.</h2>
		<div class="brewery-list">
			
		</div>

		<div class="success-text"></div>
	<?php else : ?>

		<div class="login-container">
	
			<!-- login form box -->
			<form method="post" action="util/login.php" id="loginform">
			    <label for="login_input_username">Username</label>
			    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
			    <label for="login_input_password">Password</label>
			    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
			    <input type="submit"  name="login" value="Log in" />
			</form>
		</div>
		
	<?php endif; ?>

<?php include('includes/footer.html'); ?>