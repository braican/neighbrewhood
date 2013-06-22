
<?php include('includes/header.html'); ?>
	
	<div class="login-container">

		<?php if($login->isUserLoggedIn() == true) : ?>
			
			<h1>welcome <?php echo $_SESSION['user_name']; ?></h1>
		<?php else : ?>
	
			<!-- login form box -->
			<form method="post" action="util/login.php" id="loginform">
			    <label for="login_input_username">Username</label>
			    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
			    <label for="login_input_password">Password</label>
			    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
			    <input type="submit"  name="login" value="Log in" />
			</form>

			<!-- register -->
			<h2>or register</h2>
			<!-- register form -->
			<form method="post" name="registerform" id="registerform">   
			    
			    <!-- the user name input field uses a HTML5 pattern check -->
			    <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
			    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
			    
			    <!-- the email input field uses a HTML5 email type check -->
			    <label for="login_input_email">User's email</label>    
			    <input id="login_input_email" class="login_input" type="email" name="user_email" required />        
			    
			    <label for="login_input_password_new">Password (min. 6 characters)</label>
			    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />  
			    
			    <label for="login_input_password_repeat">Repeat password</label>
			    <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />        
			    <input type="submit"  name="register" value="Register" />
			    
			</form>
		<?php endif; ?>
	</div>
		

<?php include('includes/footer.html'); ?>