/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Krank = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
	  
	  	// Contact form info messaging
	  	var cf_info = $('div.contact-form-info').text();
	  	var cf_class = $('div.contact-form-info').attr('class');
		
	  	if(cf_class === 'contact-form-info error') {
	  		var cf_alert = '<div class="'+cf_class+'"><i class="fa fa-info-circle"></i> '+cf_info+'<button class="close">&times;</button></div>';
	  	}
	  	else {
	  		var cf_alert = '<div class="'+cf_class+'"><i class="fa fa-check"></i> '+cf_info+'<button class="close">&times;</button></div>';
	  	}
	  	if(cf_info !== '') {
	  		$('.wrap').prepend(cf_alert);
	  	}
	  	$('div.contact-form-info .close').on('click',function(){
	  		$('div.contact-form-info').slideUp().fadeOut('fast');
	  	});
		
		// Bootstrap Navigation Drop Down on Rollover
		if( $(window).width() > 767 ) {
			$('ul.nav li.dropdown').mouseenter(function(){
				 $(this).children('ul.dropdown-menu').slideDown('300ms');
			});
			$('li.dropdown').mouseleave(function(){
				$('ul.dropdown-menu').fadeOut('300ms');
			})
			$('ul.dropdown-menu').mouseleave(function(){
				$(this).fadeOut('300ms');
			});
		}
		
    // Header Search Form Reveal
    $('.search-reveal').click(function() {
        var $search = $('.navbar .search-field');
        if ($search.is(':visible')) {
            // Slide away
            $search.hide(300).slideUp(300);
        }
        else {
            // Slide in
            $search.show(300).slideDown(500);
        }
    });
		
		// Sticky Nav
    $('.navbar').affix({
      	offset: {
        top: 100
      	, bottom: function () {
          return (this.bottom = $('.footer').outerHeight(true))
        }
      }
    })
		// Sticky Nav Before Fire
		$('.navbar').on('affix.bs.affix', function () {
			$(this).hide().fadeIn(300);
		});
		// Sticky Nav After Fire
		// $('.navbar').on('affix-top.bs.affix', function () {
		// 	$(this).fadeOut(300);
		// });
		
		// Post image Hover
		$('.feat-img a').mouseenter(function() {
			$(this).find('.img-more').slideToggle('fast');
		});
		$('.feat-img a').mouseleave(function() {
			$(this).find('.img-more').slideToggle('fast');
		});
		
		// Photo Gallery Modal
		$(function() {     
			$('a.thumbnail').click(function(e)
		    {
			    e.preventDefault();
		        var imgPath = $(this).data('imgpath');
		        $('#photo-modal img').attr('src', imgPath);
		        $("#photo-modal").modal('show');
		    });
		    $('img').on('click', function() {
		        $("#photo-modal").modal('hide')
		    });
		});
		
		// to top link
		$(window).scroll(function(){
			if($(this).scrollTop() > 100) {
				$('#to-top').fadeIn(300);
			} else {
				$('#to-top').fadeOut(300);
			}
		});
		// Animate Scroll to Top 
		$('#to-top').click(function(event) {
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, 300);
		});
		
		// End Common Functions
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
		
	  	// Carousel Speed
		$('.carousel').carousel({
		  interval: '4000'
		})
		
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  },
  // Single Blog Posts
  single: {
    init: function() {
      // JavaScript to be fired on the single blog page
	  
	  // Social Sharing Buttons Fade in After Load
	  $('.social-share').slideUp(300).delay(800).fadeIn(500);
    }
  }
};
// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Krank;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
