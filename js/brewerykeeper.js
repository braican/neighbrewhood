
// -------------------------------
// document ready
//
$(document).ready(function(){

	// insert brewery form
	// brewery.php
	$('#insert-brewery').on('submit', function(e){
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
		$('#insert-brewery input[type=text]').val('');
	});

	// on loginform submit
	$(document).on('submit', '#loginform', function(e){
		e.preventDefault();
		$.ajax({
			type	: "POST",
			cache	: false,
			url		: 'util/login.php',
			data	: $(this).serialize(),
			success : function(data){
				$('.login-container').html(data);
			},
			error 	: function(){
				console.log("there was an errror");
			}
		});
	});
});


