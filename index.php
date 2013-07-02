
<?php include('includes/header.php'); ?>
	<div class="wrapper clearfix">
		<div class="main-column">
			<h1>Map your beer.</h1>
			<p>The best way to find new favorites and get the most out of your beer drinking experience is to check it out right at the source. Log your journey and visualize your next brewery trip.</p>
		</div><!-- .main-column -->

		<div class="login-container" id="homepage-login-block">

			<?php if($login->isUserLoggedIn() == true) : ?>
				
				<?php include('includes/loggedin-index.php'); ?>
			<?php else : ?>
				
				<div class="slidedown">
					<h3>Have an account?</h3>
					<p class="slidedown-trigger">Login</p>
					<div class="drawer">
						<!-- login form box -->
						<form method="post" action="util/login.php" id="loginform-index">
						    <input class="login_input" type="text" name="user_name" required placeholder="username"/>
						    <input class="login_input" type="password" name="user_password" autocomplete="off" required placeholder="password" />
						    <input type="submit"  name="login" value="Log in" />
						</form>
						<div class="error-messages"></div>
					</div><!-- .drawer -->
				</div><!-- .slidedown -->

				<!-- register -->
				<div class="slidedown" id="registration-form">
					<h3>Not yet? No worries.</h3>
					<p>Register today to start tracking your brewery journey.</p>
					<p class="slidedown-trigger">Resgister</p>
					<div class="drawer">
						<!-- register form -->
						<form method="post" name="registerform" id="registerform">   
						    
						    <!-- the user name input field uses a HTML5 pattern check -->
						    <label for="login_input_username">Desired username</label>  
						    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required  />
						    
						    <!-- the email input field uses a HTML5 email type check -->
						    <label for="login_input_email">email</label>    
						    <input id="login_input_email" class="login_input" type="email" name="user_email" required />        
						    
						    <label for="login_input_password_new">Password (min. 6 characters)</label>
						    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />  
						    
						    <label for="login_input_password_repeat">Repeat password</label>
						    <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />

						    <input type="submit"  name="register" value="Register" />
					    
						</form>
					</div><!-- .drawer -->
				</div><!-- .slidedown -->
			<?php endif; ?>
		</div><!-- .login-container -->
	</div><!-- .wrapper -->

<?php include('includes/footer.php'); ?>