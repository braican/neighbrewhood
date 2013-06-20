
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

	$(document).on('submit', '#home-loginform', function(e){
		e.preventDefault();
		console.log("gogo");
		// var user = $('#login_input_username').val();
		// var pwd = $('#login_input_password').val();
		// console.log(user);
		// console.log(pwd);
		// console.log($(this).serialize());
		$.ajax({
			type	: "POST",
			cache	: false,
			url		: 'util/login.php',
			// data	: "user_name=" + user + "&user_password=" + pwd,
			data	: $(this).serialize(),
			success : function(data){
				console.log("success");
				console.log(data);
				//$('.errors').empty().html(data);
				$('.login-container').load('util/login.php');
			},
			error 	: function(){
				console.log("there was an errror");
			}
		});
	});
});


