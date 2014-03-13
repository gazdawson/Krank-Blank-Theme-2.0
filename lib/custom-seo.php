<?php
/**
 * Krank Custom SEO 
 * @package Krank
*/

// Page Titles
function krank_page_title() {
	global $post;
	
	// Get custom title
	$page_title = get_post_meta($post->ID, '_krank_seo_title', true);
	
	// If there is a title use it if not use WordPress Standard
	if($page_title) {
		$title = $page_title;
	}
	else {
		$title = wp_title('|', true, 'right');
	}
	
	echo $title;
}

// Krank search Index 
function krank_search_index() {
	global $krank;
	$krank_SEO = '<!-- Krank Search Engine Optimisation -->';
	
	$cats = isset($krank['no_index']['cats']);
	$date_arch = isset($krank['no_index']['date_arch']);
	$auth_arch = isset($krank['no_index']['auth_arch']);
	$tag_arch = isset($krank['no_index']['tag_arch']);
	$search = isset($krank['no_index']['search']);
	
	// Output va rs;
	$yes = '<meta name="robots" content="index,follow">';
	$no = '<meta name="robots" content="noindex,follow">';
	
	// Check for averall index
	if($krank['search_index'] != 0) {
		$output = $yes;
	}
	else {
		$output = $no;
	}
	
	// check for specific page types
	if( $cats == 1 && is_category() ) {
		$output = $no;
	}
	if( $date_arch == 1 && is_date() ) {
		$output = $no;
	}
	if( $auth_arch == 1 && is_author() ) {
		$output = $no;
	}
	if( $tag_arch == 1 && is_tag() ) {
		$output = $no;
	}
	if( $search == 1 && is_search() ) {
		$output = $no;
	}
	
	echo $krank_SEO.$output;
}
// Remove WP Default Meta Robots
remove_action('wp_head', 'noindex');
// Add Krank Meta Robots
add_action('wp_head', 'krank_search_index');

// Page Meta
function krank_page_meta() {
	global $post;
	global $krank;
	$meta = '';
	
	// Custom seo meta
	$meta_desc = get_post_meta($post->ID, '_krank_seo_desc', true);
	$meta_key = get_post_meta($post->ID, '_krank_seo_key', true);
	$global_key = $krank['global_key'];
	$google_plus = $krank['google_plus'];
	
	// Meta Description
	if ($meta_desc) {
		$meta .= '<meta name="description" content="'.$meta_desc.'">';
	}
	
	// Meta keywords
	if ($global_key || $meta_key) {
		$meta .= '<meta name="keywords" content="'.$global_key.', '.$meta_key.'">';
	}
	
	// Google + Author Link
	if($google_plus) {
		$meta .= '<link rel="author" href="'.$google_plus.'">';
	}
	
	echo $meta;
}
// Add new Krank meta to head
add_action('wp_head', 'krank_page_meta');

// Breadcrumbs to pages
function krank_breadcrumbs() {
	global $krank;
	$breadcrumb = $krank['breadcrumbs'];
	
	$output = '';
  $output .= '<div class="breadcrumbs"><div class="container"><ul class="breadcrumb">';
	
// Master Page
  $output .= '<li><a href="'.get_option('home').'" title="'.get_option('blogname').' | '.get_option('blogdescription').'">Home</a></li>';
// Categories and Single
  if (is_category() || is_single()) {
		$category = get_the_category();
    $cat_name = $category[0]->cat_name;
		$cat_link = $category[0]->slug;
	
		$output .= '<li><a href="/category/'.$cat_link.'" title="View '.$cat_name.' Category">'.$cat_name.'</a></li>';
	
      if (is_single()) {
          $output .= '<li>'.get_the_title().'</li>';
      }
  }
	if (is_page()) {
		$output .= '<li>'.get_the_title().'</li>';
  }
  elseif (is_tag()) {
		$tag = single_tag_title("", false);
		$output .= '<li>'.$tag.'</li>';
	}
  elseif (is_day()) {
		$output .= '<li>Archive for'.get_the_time('F jS, Y').'</li>';
	}
  elseif (is_month()) {
		$output .= '<li>Archive for '.get_the_time('F, Y').'</li>';
	}
  elseif (is_year()) {
		$output .= '<li>Archive for '.get_the_time('Y').'</li>';
	}
  elseif (is_author()) {
		$output .= '<li>Author Archive</li>';
	}
  elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		$output .= '<li>Blog Archives</li>';
	}
  elseif (is_search()) {
		$search = get_search_query();
		$output .= '<li>Search Results For "'.$search.'"</li>';
	}
 		$output .= '</ul></div></div><!--/.breadcrumbs-->';
   
   // echo the breadcrumb
   if (!is_front_page()){
	   echo $output;
   }
}

// Krank XML Site Map Generator
function krank_build_sitemap() {
	global $krank;
	$enable = $krank['sitemap_enable'];
	$frequency = $krank['change_freq'];
	
	$postsForSitemap = get_posts(array(
		'numberposts' => -1,
		'orderby' => 'modified',
		'post_type'  => array('post','page'),
		'order'    => 'DESC'
	));

	$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
	$sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><!-- Krank XML Sitemap Generator -->';

	foreach($postsForSitemap as $post) {
	setup_postdata($post);

	$postdate = explode(" ", $post->post_modified);

	$sitemap .= 
	'<url>'.
		  '<loc>'. get_permalink($post->ID) .'</loc>'.
		  '<lastmod>'. $postdate[0] .'</lastmod>'.
		  '<changefreq>'. $frequency .'</changefreq>'.
	'</url>';
	}

	$sitemap .= '</urlset>';

	$fp = fopen(ABSPATH . "sitemap.xml", 'w');
	if ($enable == 1) {
		fwrite($fp, $sitemap);
		fclose($fp);
	}
}
add_action("publish_post", "krank_build_sitemap");
add_action("publish_page", "krank_build_sitemap");