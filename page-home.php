<?php
/**
 * Template Name: Home
 * @package Krank Theme
 */
?>
<?php
	// krank_carousel($slide_type, $id, $controls, $indicators, $captions, $trans)
	if ($krank['home_slides_switch'] == 1) {
		krank_carousel('home_slides', 'home-carousel', true, true, true, 'slide'); 
	}
?>
<?php get_template_part('templates/content', 'page'); ?>
