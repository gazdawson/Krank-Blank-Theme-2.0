<?php
/**
 * Template Name: Contact
 * @package Krank Theme
 */
?>

<div class="container header">
	<?php get_template_part('templates/page', 'header'); ?>
</div>

<div class="full-width">
	<div id="map"></div>
	<div class="contact-sidebar">
		<div class="container">
			<div class="contact-side-content">
				<h3>Contact Us</h3>
				<?php echo do_shortcode('[contact]'); ?>
				<h4>Send a Message</h4>
				<?php echo do_shortcode('[contact-form]'); ?>
			</div>
		</div>
	</div>
</div>

<div class="container content">
	<?php get_template_part('templates/content', 'page'); ?>
</div>

<?php
	// Load Krank Options
	$location = $krank['location']['latitude'].', '.$krank['location']['longitude'];
	$name = $krank['name'];
	foreach($krank['address'] as $add) {
		$address .= $add.'<br/>';
	}
	$infoWindow = '<div class="infoWindow"><h4>'.$name.'</h4>'.'<p>'.$address.'</p></div>';
?>

<script>
// Google Map
	function initialize() {
		var myLatlng = new google.maps.LatLng(<?php echo $location; ?>);
		var mapOptions = {
			zoom: 17,
			center: myLatlng
		};

		var map = new google.maps.Map(document.getElementById('map'), mapOptions);

		var contentString = '<?php echo $infoWindow; ?>';

		var infowindow = new google.maps.InfoWindow({
		  content: contentString,
		  minWidth: 200,
		  minHeight: 200
		});

		var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: map,
		  animation: google.maps.Animation.DROP
		});
	
		google.maps.event.addListener(marker, 'load', function() {
			infowindow.open(map,marker);
		});
		infowindow.open(map,marker);
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
