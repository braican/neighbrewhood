<?php include('util/lock.php'); ?>

<html>
<head>
	<title>BreweryKeeper</title>

	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css">
	
</head>
<body>

<div class="container">
	
	<h1>BreweryKeeper</h1>
	<h1>welcome <?php echo $login_session; ?></h1>
	<h2>the <a href="brewery-list.php">list of breweries</a>.</h2>
	<div class="brewery-list">
		
	</div>

	<div class="success-text"></div>
</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</body>
</html>
