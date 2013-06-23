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

<?php if ($loggedin == true) : ?>
	<h1>My Breweries</h1>
	<section class="user-breweries">
		<?php
			if(file_exists('util/get-user-breweries.php')){
				require_once('util/get-user-breweries.php');
			} else {
				require_once('../util/get-user-breweries.php');
			}
		?>
	</section>

	<section>
		<h3>Been to a new place?</h3>
		<div class="errors"></div>
		<!-- add brewery -->
		<form method="post" id="add-user-brewery">
		    <label for="add_brewery">Name</label>
		    <input id="add_brewery" type="text" name="add_brewery" required />
		    <input type="hidden" name="user" value="<?php echo $u; ?>">
		    <input type="submit"  name="login" value="Add" />
		</form>
	</section>
<?php else : ?>
	<div class="main-column">
		<h2>Track your breweries.</h2>
		<p><a href="#" class="floating-login">Log in</a> or <a href="index.php?register">register</a> today to get your own list of breweries, mapped out special just for you to help plan and record your brewery journey.</p>
	</div>

	<div class="login-container">

		<div class="slidedown">
			<h3>Log in to view your list of breweries</h3>
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
	</div>
	
<?php endif; ?>