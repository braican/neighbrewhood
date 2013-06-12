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
		<h1>Add a brewery</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>">

		</form>
	</div>

	<div class="success-text"></div>

<script>
	
	$('form').on('submit', function(e){
	    e.preventDefault();
	    $.ajax({
	        type     : "POST",
	        cache    : false,
	        url      : $(this).attr('action'),
	        data	 : $(this).serialize(),
	        success  : function(data) {

	            $(".success-text").empty().html('success').animate({opacity:1});
	            setTimeout(function(){
	            	$(".success-text").animate({opacity:0});
	            }, 10000);
	        }
	    });

		$('form input[type=text]').val('');

	});

</script>
</body>
</html>