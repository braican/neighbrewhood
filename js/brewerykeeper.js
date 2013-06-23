
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

	// link up floating login links
	// - these can exist anywhere
	$('.floating-login').on('click', function(e){
		e.preventDefault();
		if($('.login-container .slidedown .drawer').length != 0){
			$('.login-container .slidedown .drawer').slideDown();	
		} else {
			$('.login-prompt').animate({
				'top' : '-' + $('.login-prompt').outerHeight() + 'px'
			}, 200, function(){
				$('.account-links').css({
					'display' : 'block'
				}).animate({
					'top' : '0px'
				});
			});
		}
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
	// google maps
	//
	mapInit();


	// -------------------------------
	// FORMS
	//

	// insert brewery form
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
					if($('.brewery-list').length != 0){
						window.location.href = 'my-breweries.php';
					}
					$('.my-breweries').hide().load('includes/my-breweries-include.php?logged', function(){
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

	// register
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

	// add user breweries
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

function mapInit(){
	var mapOptions = {
		center: new google.maps.LatLng(42.16208590, -72.4711490),
		zoom: 8,
		mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	var map = new google.maps.Map(document.getElementById("map-all-breweries"), mapOptions);

	$.ajax({
		url		: "util/map-all-breweries.php",
		success : function(addresses){
			var address_obj = $.parseJSON(addresses);
			var i;
			for(i = 0; i < address_obj.length; i++){
				var geocoder = new google.maps.Geocoder();
				geocoder.geocode({'address' : address_obj[i]}, function(result, status){
					if (status == google.maps.GeocoderStatus.OK) {
						console.log(result[0]['geometry']['location']);
						var lat = result[0]['geometry']['location']['jb'];
						var lng = result[0]['geometry']['location']['kb'];
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng(lat, lng),
							map: map
						});
					}
				});
			}
		}
	});
}