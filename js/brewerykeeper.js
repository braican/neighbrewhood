
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
	// login ux
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

	// start the login prompt above so it can slide down 
	//  on page load
	$('.login-prompt').animate({
		'top' : '0px'
	});

	// link up the floating login links
	$('.floating-login').on('click', function(e){
		e.preventDefault();
		$('.login-container .slidedown .drawer').slideDown();
	});

	// register 
	$('.register-slideout').on('click', function(e){
		e.preventDefault();
		var offset = $('#registration-form').offset().top;
		console.log(offset);
		$('html, body').animate({scrollTop : offset}, 400, function(){
			$('#registration-form .drawer').addClass('opendrawer').slideDown(400, function(){
				$('html, body').animate({scrollTop : offset});
			});
		});
	});

	var queryString = window.location.href.substr(window.location.href.indexOf('?')+1);
	if(queryString == 'register'){
		var offset = $('#registration-form').offset().top;
		console.log(offset);
		$('html, body').animate({scrollTop : offset}, 400, function(){
			$('#registration-form .drawer').addClass('opendrawer').slideDown(400, function(){
				$('html, body').animate({scrollTop : offset});
			});
		});
	}

	// -------------------------------
	// slidedown interaction
	//
	$('.slidedown-trigger').on('click', function(e){
		e.preventDefault();
		var $t = $(this).siblings('.drawer');
		if(!$(this).siblings('.drawer').hasClass('opendrawer')){
			if($('.slidedown .opendrawer').length > 0){
				$('.slidedown .opendrawer').slideUp(400, function(){
					$('.slidedown .drawer').removeClass('opendrawer');
					$t.slideDown().addClass('opendrawer');
				});	
			} else {
				$t.slideDown().addClass('opendrawer');
			}	
		}
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

					$('.my-breweries').hide().load('includes/my-breweries-login.php?logged', function(){
						$(this).fadeIn();
					});
					$('.login-container').hide().load('includes/loggedin-index.php', function(){
						$(this).fadeIn();
					});
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

	// logout
	$(document).on('click', '.logout-btn', function(e){
		console.log("clicked lofout");
		e.preventDefault();
		$.ajax({
			type	: "POST",
			cache	: false,
			url		: 'util/logout.php',
			data	: $(this).serialize(),
			success : function(data){
				document.location.reload();
			},
			error 	: function(){
				console.log("there was an errror");
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


