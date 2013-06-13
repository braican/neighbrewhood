<html>
<head>
	<title>BreweryKeeper</title>

	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css">
	
</head>
<body>

<div class="container">
	
	<h1>BreweryKeeper</h1>
	<h2>keep track of the breweries you've visited.</h2>
	<div class="login">
		<?php
			include("util/db_util.php");
			$db = dbconnect();
			session_start();
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				// username and password sent from form
				$user = addslashes($_POST['username']);
				$pwd = addslashes($_POST['password']);

				$sql = "SELECT username FROM users WHERE username='$user' and password='$pwd'";
				if(!$result = $db->query($sql)){
					die('There was an error running the query [' . $db->error . ']');
				}

				$count = $result->num_rows;

				if($count == 1){
					$_SESSION['login_user'] = $user;
					header('Location: my-breweries.php');
				} else {
					echo "not login";
				}
			}
		?>

		<form action="" method="post">
		<label>UserName :</label>
		<input type="text" name="username"/><br />
		<label>Password :</label>
		<input type="password" name="password"/><br/>
		<input type="submit" value=" Submit "/><br />
		</form>


	</div>
</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/brewerykeeper.js"></script>
</body>
</html>