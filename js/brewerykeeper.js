
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
			$('html, body').animate({scrollTop : 0});
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
		if($('#homepage-login-block').length != 0){
			e.preventDefault();
			var offset = $('#registration-form').offset().top;
			console.log(offset);
			$('html, body').animate({scrollTop : offset}, 400, function(){
				$('#registration-form .drawer').addClass('opendrawer').slideDown(400, function(){
					$('html, body').animate({scrollTop : offset});
				});
			});	
		}
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
	// brewery list interactions
	//
	$('.brewery-list .row .name').on('click', function(event) {
		event.preventDefault();
		console.log($(this));
		if($(window).width() <= 680){
			if($(this).siblings('.small-address').length != 0){
				$(this).siblings('.small-address').remove();
			} else {
				var addr = $(this).siblings('.address').text();
				$(this).parent().append('<div class="small-address">' + addr + '</div>');	
			}			
		}

		var lat = $(this).parent().attr('data-lat'),
			lng = $(this).parent().attr('data-lng'),
			name = $(this).text();
		centerMapOnPoint(lat, lng, name);
	});

	// -------------------------------
	// google maps
	//
	if($('.map').length > 0)
		mapInit();


	// -------------------------------
	// FORMS
	//

	// insert brewery form
	$('#insert-brewery').on('submit', function(e){
	    e.preventDefault();
	    
	    $.ajax({
	        type     : "POST",
	        cache    : false,
	        url      : $(this).attr('action'),
	        data	 : $(this).serialize(),
	        success  : function(data) {
	        	console.log(data);
	            $(".success-text").empty().html(data).slideDown();
	            setTimeout(function(){
	            	$(".success-text").animate({opacity:0});
	            }, 8000);

	            if(! data.substring(0, 9) == '<p>Whoops'){
	            	$('#insert-brewery input[type=text]').val('');
	            }
	        },
	        error	: function(){
	        	console.log("BOO");
	        }
	    });
	});

	// on loginform submit
	$(document).on('submit', '#loginform-index, #loginform-header, #loginform-my-breweries', function(e){
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
			url	: 'util/add-user-brewery.php',
			data	: $(this).serialize(),
			success : function(data){
				console.log(data);
				$('.errors').empty().html(data).slideDown();
				$('.user-breweries').load('util/get-user-breweries.php');
				$(this).find('input[type=text]').val('');
			},
			error 	: function(){
				console.log("there was an errror");
			}
		});
	});

	// zipsearch
	$('#zipsearch').on('submit', function(event) {
		event.preventDefault();
		var zip = $(this).find('input[name=zipsearch]').val();
		moveMap(zip)
	});
});


// -------------------------------
// map init
//
var map,
	infobubble = null,
	geocoder = new google.maps.Geocoder();
	markers = new Array();

function mapInit(){
	var mapOptions = {
		center: new google.maps.LatLng(42.16208590, -72.4711490),
		zoom: 8,
		mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	map = new google.maps.Map(document.getElementById("map-all-breweries"), mapOptions);

	//ajax for the visited breweries
	$.ajax({
		url		: "util/map-all-breweries.php?mine",
		success  : function(brewery){
			console.log(brewery);
			var brewery_obj = $.parseJSON(brewery);
			for(var i = 0; i < brewery_obj.length; i++){
				putMarker(brewery_obj, i, 'assets/marker-visited.png');
			}
		}
	});

	// ajax for not visited breweries
	$.ajax({
		url		: "util/map-all-breweries.php",
		success  : function(brewery){
			console.log(brewery);
			var brewery_obj = $.parseJSON(brewery);

			for(var i = 0; i < brewery_obj.length; i++){
				putMarker(brewery_obj, i, 'assets/no-marker.png');
			}
		}
	});
}

// places all the markers
function putMarker(brewery_obj, i, icon){
	var name = brewery_obj[i]['name'];
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(brewery_obj[i]['lat'], brewery_obj[i]['lng']),
		icon:icon,
		flat:true,
		map: map
	});
	
	new google.maps.event.addListener(marker, 'click', function(){
	   // new google.maps.InfoWindow({
	   //     content: '<p>' + name + '</p>'
	   // }).open(map, marker);
		if(infobubble){
			infobubble.close();
		}

		infobubble = new InfoBubble({
			content: name,
			padding:20
		});
		infobubble.open(map, marker);
	});
	markers[name] = marker;
}

// centers the map on a lat, lng point
function centerMapOnPoint(lat, lng, name){
	map.panTo(new google.maps.LatLng(lat, lng));
	map.setZoom(12);
	if(infobubble){
		infobubble.close();
	}

	infobubble = new InfoBubble({
		content: name,
		padding:20
	});
	infobubble.open(map, markers[name]);
}

// changes the address
function moveMap(address){
	geocoder.geocode({'address' : address}, function(results, status){
		if(status == google.maps.GeocoderStatus.OK){
			map.panTo(results[0].geometry.location);
			map.setZoom(12);
		} else {
			alert('not successful: ' + status);
		}
	});
}