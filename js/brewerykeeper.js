
// 
// bk (namespace)
//
(function(bk, $, undefined){

	// -------------------------------
	// PUBLIC
	//
	// properties
	bk.property = '';


	// -------------------------------
	// PRIVATE
	//
	// properties
	var privateProperty = '';

	// -------------------------------
	// PRIVATE
	//
	// methods
	//


	// -------------------------------
	// PUBLIC
	//
	// methods
	//
	bk.init = function(){
		
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

	};

	// -------------------------------
	// document ready
	//
	$(document).ready(function(){bk.init();});

}(window.bk = window.bk || {}, jQuery));
