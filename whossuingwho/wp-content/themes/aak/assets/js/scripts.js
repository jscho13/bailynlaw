
( function( $ ) {
	"use strict";

	jQuery(document).ready(function($){

		$('#primary-menu li.menu-item').addClass('menuhide');
		$('#primary-menu li.menu-item').on('click', function(){
		$(this).removeClass('menuhide');
		});

		$('.mini-toggle').on('click', function(){
		   $(this).parent().toggleClass('menushow');
		});
		$('.grid').masonry({
		  itemSelector: '.grid-item',
		  columnWidth: '.grid-item',
		  percentPosition: true
		})
	

	}); // document ready

	$.fn.aakAccessibleDropDown = function () {
		 var el = $(this);

			    /* Make dropdown menus keyboard accessible */

			  $("button.mini-toggle", el).focus(function() {
			        $(this).parents("li").addClass("befocus");
			  })/*.blur(function() {
			        $(this).parents("li").removeClass("befocus");
			  });*/
	}
	 $("#primary-menu").aakAccessibleDropDown();
	
}( jQuery ) );