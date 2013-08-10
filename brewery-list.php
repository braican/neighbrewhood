
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
	</section>
	<section class="filter-breweries">
		<div class="wrapper">
			<div class="header clearfix">
				<h3>Filter Breweries</h3>
				<span class="orange-button">Show all</span>
			</div>
			<form action="#" id="filter-form">
				<div class="clearfix">
					<div class="filter-option">
						<label for="brewery_state">State</label>
						<select name="brewery_state" data-placeholder="Select a state">
							<option value=""></option>
							<option value="">All</option>
							<option value="AL">Alabama</option> 
							<option value="AK">Alaska</option> 
							<option value="AZ">Arizona</option> 
							<option value="AR">Arkansas</option> 
							<option value="CA">California</option> 
							<option value="CO">Colorado</option> 
							<option value="CT">Connecticut</option> 
							<option value="DE">Delaware</option> 
							<option value="DC">District Of Columbia</option> 
							<option value="FL">Florida</option> 
							<option value="GA">Georgia</option> 
							<option value="HI">Hawaii</option> 
							<option value="ID">Idaho</option> 
							<option value="IL">Illinois</option> 
							<option value="IN">Indiana</option> 
							<option value="IA">Iowa</option> 
							<option value="KS">Kansas</option> 
							<option value="KY">Kentucky</option> 
							<option value="LA">Louisiana</option> 
							<option value="ME">Maine</option> 
							<option value="MD">Maryland</option> 
							<option value="MA">Massachusetts</option> 
							<option value="MI">Michigan</option> 
							<option value="MN">Minnesota</option> 
							<option value="MS">Mississippi</option> 
							<option value="MO">Missouri</option> 
							<option value="MT">Montana</option> 
							<option value="NE">Nebraska</option> 
							<option value="NV">Nevada</option> 
							<option value="NH">New Hampshire</option> 
							<option value="NJ">New Jersey</option> 
							<option value="NM">New Mexico</option> 
							<option value="NY">New York</option> 
							<option value="NC">North Carolina</option> 
							<option value="ND">North Dakota</option> 
							<option value="OH">Ohio</option> 
							<option value="OK">Oklahoma</option> 
							<option value="OR">Oregon</option> 
							<option value="PA">Pennsylvania</option> 
							<option value="RI">Rhode Island</option> 
							<option value="SC">South Carolina</option> 
							<option value="SD">South Dakota</option> 
							<option value="TN">Tennessee</option> 
							<option value="TX">Texas</option> 
							<option value="UT">Utah</option> 
							<option value="VT">Vermont</option> 
							<option value="VA">Virginia</option> 
							<option value="WA">Washington</option> 
							<option value="WV">West Virginia</option> 
							<option value="WI">Wisconsin</option> 
							<option value="WY">Wyoming</option>
						</select>
					</div><!-- .filter-option -->

					<div class="filter-option">
						<label for="brewery_city">City</label>
						<select name="brewery_city" data-placeholder="Select a city">
							<option value=""></option>
							<option value="">All</option>
							<option value="Boston">Boston</option>
						</select>
					</div><!-- .filter-option -->
				</div>
				<input type="submit" value="Filter">
			</form>
		</div>
	</section>
	<section class="brewery-list">
		<?php include("util/get-breweries.php"); ?>
	</section>
	<section>
		<div class="wrapper">
			<h3>Search map by zip code</h3>
			<form id="zipsearch">
				<input type="text" placeholder="zip" name="zipsearch">
				<input type="submit" value="Search">
			</form>
		</div>
	</section>
	<section class="map" id="map-all-breweries">
		
	</section>

<?php include('includes/footer.php'); ?>
