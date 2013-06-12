<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add brewery utility</title>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../style.css">
</head>
<body>
	
	<div>
		<!-- <h1>Add a brewery</h1> -->
		<form action="insert-brewery.php">
			<input type="text" name="brewery_name" placeholder="name">
			<input type="text" name="brewery_address" placeholder="address">
			<input type="text" name="brewery_city" placeholder="city">
			<select name="brewery_state"> 
				<option value="" selected="selected">Select a State</option> 
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
			<input type="text" name="brewery_zip" placeholder="zip">
			<input type="text" name="brewery_website" placeholder="brewery website">
			<input type="text" name="ba_link" placeholder="link to BeerAdvocate.com" size="30">
			<input type="submit" value="Submit">
		</form>
	</div>

	<div class="success-text"></div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
	
	$('form').on('submit', function(e){
	    e.preventDefault();
	    $.ajax({
	        type     : "POST",
	        cache    : false,
	        url      : $(this).attr('action'),
	        data	 : $(this).serialize(),
	        success  : function(data) {
	        	console.log(data);
	            $(".success-text").empty().html(data).animate({opacity:1});
	            setTimeout(function(){
	            	$(".success-text").animate({opacity:0});
	            }, 10000);
	        },
	        error	: function(){
	        	console.log("BOO");
	        }
	    });

		$('form input[type=text]').val('');

	});

</script>
</body>
</html>