<?php include('includes/header.html'); ?>

<?php include('includes/nav.html'); ?>

<!-- 	<h1>BreweryKeeper</h1>
	<h2>your <a href="my-breweries.php">breweries</a>.</h2> -->
	<div class="brewery-list">
		<?php include("util/get-breweries.php"); ?>
	</div>

	<div class="success-text"></div>

<?php include('includes/footer.html'); ?>
