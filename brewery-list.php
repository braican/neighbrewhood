
<?php include('includes/header.php'); ?>
	
	<section class="wrapper">
		<h1>Brewery List</h1>
		<?php if($login->isUserLoggedIn() == true) : ?>
			<p>Been to one of these breweries? <a href="my-breweries.php">Add it</a> to your list.</p>
		<?php else : ?>
			<p>Been to one of these breweries? <a href="#" class="floating-login">Log in</a> to add it to your list, or <a href="index.php?register">register</a> to begin your journey today.</p>
		<?php endif; ?>
		<div class="brewery-list">
			<?php include("util/get-breweries.php"); ?>
		</div>
	</section>

<?php include('includes/footer.php'); ?>
