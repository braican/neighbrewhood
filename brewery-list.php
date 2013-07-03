
<?php include('includes/header.php'); ?>
	
	<section>
		<div class="wrapper">
			<h1>Brewery List</h1>
			<?php if($login->isUserLoggedIn() == true) : ?>
				<p>Been to one of these breweries? <a href="my-breweries.php">Add it</a> to your list.</p>
				<p>Don't see a brewery on this list? Help out and <a href="add-brewery.php">add it</a>.</p>
			<?php else : ?>
				<p>Been to one of these breweries? <a href="#" class="floating-login">Log in</a> to add it to your list, or <a href="index.php?register">register</a> to begin your journey today.</p>
			<?php endif; ?>
		</div>
		<div class="brewery-list">
			<?php include("util/get-breweries.php"); ?>
		</div>
	</section>
	<section>
		<div class="wrapper">
			<h2>Search by zip code</h2>
			<form id="zipsearch">
				<input type="text" placeholder="zip" name="zipsearch">
				<input type="submit" value="Search">
			</form>
		</div>
	</section>
	<section class="map" id="map-all-breweries">
		
	</section>

<?php include('includes/footer.php'); ?>
