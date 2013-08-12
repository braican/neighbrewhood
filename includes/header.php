
<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>BreweryKeeper</title>

	<link href='http://fonts.googleapis.com/css?family=Lato:400,700|Lobster' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-20596099-9']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>
<body>

<header id="banner">
	<div class="title-container">
		<h1 class="site-title">BreweryKeeper<sup>beta</sup></h1>
	</div>
	
	<div class="account-nav">
		<?php include('includes/login-navigation.php'); ?>
	</div><!-- .account-nav -->

	<div class="banner-container">
		<h2>Keep track of the breweries you've visited</h2>
	</div>
</header>

<div class="container">
	<nav id="main-nav">
		<ul>
			<li><a <?php if (strpos($_SERVER['PHP_SELF'], 'my-breweries.php')) echo 'class="active"';?> href="my-breweries.php">My Breweries</a></li>
			<li><a  <?php if (strpos($_SERVER['PHP_SELF'], 'brewery-list.php')) echo 'class="active"';?> href="brewery-list.php">List of Breweries</a></li>
		</ul>
	</nav>