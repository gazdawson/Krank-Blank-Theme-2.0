<?php
/**
 * Krank Custom Functions
 * @package Krank
*/

// Bootstrap Carousels
function krank_carousel($slide_type, $id, $controls, $indicators, $captions, $trans) {
	global $krank; // Global variable for custom options
	$indicator = '';
	$items = '';
	
	// Slide or fade
	if($trans == 'fade'){
		$transition = 'carousel slide carousel-fade';
	}
	else {
		$transition = 'carousel slide';
	} 
	
	// Loop
	$count = 0;
	foreach($krank[$slide_type] as $slides) {
		
		$title = $slides['title'];
		$description = $slides['description'];
		$link = $slides['url'];
		$images	=	$slides['image'];
		$images_height = $slides['height'];
		$images_width =	$slides['width'];
		
		// .active class for first slide
		if ($count === 0 ) {
			$active = ' active'; 
		}
		else {
			$active = ''; 
		}
		
		// Carousel Controls
		if ($controls != false) {
			$control =
		        '<a class="left carousel-control" href="#'.$id.'" data-slide="prev">
			        <span class="krank-ico fa-caret-left"></span>
		        </a>
		        <a class="right carousel-control" href="#'.$id.'" data-slide="next">
					<span class="krank-ico fa-caret-right"></span>
		        </a>';
		}
		
		// Carousel Indicators
		if ($indicators != false) {
			$indicator .=
				'<li data-target="#'.$id.'" data-slide-to="'.$count.'" class="'.$active.'"></li>';
		}
		
		// Carousel Captions
		if ($captions != false) {
			$caption =
			 	'<div class="carousel-caption">
			 		<span class="carousel-title">'.$title.'</span>
			 		<p class="carousel-description">'.$description.'</p>'.
			 	'</div>';
		}
		
		// Carousel Images
		if($images != "") {
			$image =
				'<img src="'.$images.'" alt="'.$title.'" class="carousel-img" width="'.$images_width.'" height="'.$images_height.'" />';
		}
		
		// Carousel Slides
		$items .=
			'<div class="item'.$active.'">'.
				'<a href="'.$link.'" title="'.$title.'">'.
					$image.
					$caption.
				'</a>'.
			'</div>';
	
	// End Loop
	$count++;
	}
	
	$output = // Putting it all together
		'<div id="'.$id.'" class="'.$transition.'" data-ride="carousel">
			<ol class="carousel-indicators">'.
				$indicator.
			'</ol>
			<div class="carousel-inner">'.
				$items.
			'</div>'.
			$control.
		 '</div><!--/#'.$id.'-->';
		 
	echo $output;
}

// Structured Data Address
function krank_structured_business() {
	global $krank;
	$address_lines = '';
	$contact_lines = '';
	$open_lines = '';
	
	// Business Name
	if($krank['name']) {
		$business_name = $krank['name'];
	}
	// Address Loop
	foreach($krank['address'] as $key => $value) {
		if($value) {
			$address_lines .= '<span itemprop="'.$key.'">'.$value.'</span> ';
		}
	}
	foreach($krank['contact'] as $key => $value) {
		if($value) {
			$contact_lines .= '<abbr title="'.ucFirst($key).'">'.substr($key,0,1).': </abbr><span itemprop="'.$key.'">'.$value.'</span> ';
		}
	}
	foreach($krank['open'] as $key => $value) {
		if($value) {
			$opens = substr($value,0,5).':00';
			$closes = substr($value,8,99).':00';
			$open_lines .= 
				'<span itemprop="dayOfWeek" itemscope itemtype="http://schema.org/DayOfWeek">
					<span itemprop="name">'.$key.'</span>
				</span>
				<meta itemprop="opens" content="'.$opens.'">
				<meta itemprop="closes" content="'.$closes.'">';
		}
	}
	// Address HTML with Google structured data
	$business_info =
		'<div itemscope itemtype="http://schema.org/LocalBusiness" class="business-info">'.
			'<span class="copy">&copy; '.date('Y').' </span>'.
			'<span itemprop="name" class="name">'.$business_name.' | </span>
			 <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="address">'.
				$address_lines.
			'</div><!--/.address-->
			<div class="contact">'.
				$contact_lines.
			'</div><!--/.contact-->
			<div itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/OpeningHoursSpecification" class="opening">'.
				$open_lines.
			'</div><!--/.opening-->
		  </div>';
	// Location HTML with Google structured data
	$location =
		'<div itemscope itemtype="http://schema.org/Place" class="location">
		  <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
		    <meta itemprop="latitude" content="'.$krank['location']['latitude'].'" />
		    <meta itemprop="longitude" content="'.$krank['location']['longitude'].'" />
		  </div>
		</div>';
		
	// Return Output
	return $business_info.$location;
}

// More link Button instead of ...continued
function excerpt_read_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'excerpt_read_more' );

// Social Sharing Buttons
function krank_social_share() {
	global $post;
	global $krank;
	
	$social_btns = '';
	$social = '';
	$social_jquery = '';
	
	if (!empty($krank['social_share'])){
		$social_btns = $krank['social_share'];
	}
	
	if ($social_btns) {
		foreach($social_btns as $key => $value) {
			if ($key == 'googlePlus'){
				$icon = 'google-plus';
			}
			else {
				$icon = $key;
			}
			$social .= '<div id="'.$key.'" data-url="'.get_permalink($post->ID).'" data-text="Check out &quot;'.get_the_title().'&quot; on '.get_option('blogname').' | " data-title="Share"></div>';
			$social_jquery .= '
				$(\'#'.$key.'\').sharrre({
				  share: {
				    '.$key.': true
				  },
				  template: \'<i class="fa-'.$icon.' share"></i><span class="count" href="#">{total}</span>\',
				  enableHover: true,
				  enableTracking: true,
				  urlCurl: \'\',
				  click: function(api, options){
				    api.simulateClick();
				    api.openPopup(\''.$key.'\');
				  }
				});';
		}
	}

	echo $social . '<script>'.$social_jquery.'</script>';
}