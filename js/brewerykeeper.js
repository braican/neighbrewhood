
// -------------------------------
// document ready
//
$(document).ready(function(){

	// -------------------------------
	// autocomplete
	//
	$('#add_brewery').autocomplete({
		source: "util/brewery-autocomplete.php",
		dataType: "json"
	});

	// -------------------------------
	// login ui
	//

	// at the start, get the height of the acount-links
	//  so we can hide it the appropriate amount
	var accountLinksHeight = $('.account-links').outerHeight();
	
	$('.account-links').css({
		'top' : '-' + accountLinksHeight + 'px'
	});
	$(document).on('click', '.login-prompt', function(e){
		e.preventDefault();
		$(this).animate({
			'top' : '-' + $(this).outerHeight() + 'px'
		}, 200, function(){
			$('.account-links').css({
				'display' : 'block'
			}).animate({
				'top' : '0px'
			});
		});
	});

	// close the account links dropdown
	$(document).on('click', '.close-account-links', function(e){
		e.preventDefault();
		$('.account-links').animate({
			'top' : '-' + accountLinksHeight + 'px'
		}, 400, function(){
			$('.login-prompt').animate({
				'top' : '0px'
			});
		});
	});

	$('.login-prompt').animate({
		'top' : '0px'
	});

	// -------------------------------
	// FORMS
	//

	// insert brewery form
	// brewery.php
	$('#insert-brewery').on('submit', function(e){
	    e.preventDefault();
	    console.log("gogo");
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
				console.log(data);
				if(data == 1){
					$('.login-container').html(data);
					$('.account-links').animate({
						'top' : '-' + accountLinksHeight + 'px'
					}, 400, function(){
						$('.account-nav').load('includes/login-navigation.php?logged', function(){
							var dynamicAcctLinksHeight = $('.account-links').outerHeight();
							$('.account-links').css({
								'top' : '-' + dynamicAcctLinksHeight + 'px'
							});
							$('.login-prompt').animate({
								'top' : '0px'
							});
						});
					});	
				} else {
					//console.log("no login");
					$('.error-messages').html('Wrong username or password').slideDown();
				}
			},
			error 	: function(){
				console.log("there was an error");
			}
		});
	});

	$('#registerform').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			type	: "POST",
			cache	: false,
			url		: 'util/register.php',
			data	: $(this).serialize(),
			success : function(data){
				$('.login-container').html(data);
			},
			error 	: function(){
				console.log("there was an errror");
			}
		});
	});

	$('#add-user-brewery').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			type	: "POST",
			cache	: false,
			url		: 'util/add-user-brewery.php',
			data	: $(this).serialize(),
			success : function(data){
				$('.errors').html(data);
				$('.user-breweries').load('util/get-user-breweries.php');
			},
			error 	: function(){
				console.log("there was an errror");
			}
		});
	});
});


