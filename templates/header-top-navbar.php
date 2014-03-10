<?php global $krank; ?>
<header class="banner navbar navbar-default navbar-fixed-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <?php 
	  	if($krank['logo']['url']) {
	  		$background = 'background: url(\''.$krank['logo']['url'].'\');';
	  	}
	  ?>
	  <a class="navbar-brand" href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>" style="<?php echo $background; ?>">
		  <span class="name"><?php bloginfo('name'); ?></span>
	  </a>
    </div>
	<div class="contactModal">
		<button class="btn btn-outline" data-toggle="modal" data-target="#contactModal">Contact</button>
	</div>
    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
	  	<div class="search">
	  		<?php get_search_form(); ?>
	  		<i class="search-reveal fa-search"></i>
	  	</div>
    </nav>
  </div>
</header>