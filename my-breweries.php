
<?php include('includes/header.php'); ?>

	<?php if ($login->isUserLoggedIn() == true) : ?>
		
		<h1>welcome <?php echo $u; ?></h1>
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

	<?php if ($login->isUserLoggedIn() == true) : ?>

		<div class="errors"></div>
		<div class="user-breweries">

			<?php require_once('util/get-user-breweries.php'); ?>
		</div>

		<h1>Been to a new place?</h1>
		<!-- add brewery -->
		<form method="post" id="add-user-brewery">
		    <label for="add_brewery">Name</label>
		    <input id="add_brewery" type="text" name="add_brewery" required />
		    <input type="hidden" name="user" value="<?php echo $u; ?>">
		    <input type="submit"  name="login" value="Add" />
		</form>
	<?php endif; ?>

<?php include('includes/footer.php'); ?>