<a href="#" id="to-top"><i class="fa-angle-up"></i></a>
<footer class="content-info" role="contentinfo">
  <div class="footer container">
	<div class="row">
	    <?php dynamic_sidebar('sidebar-footer'); ?>
			<?php echo krank_social(); ?>
	    <nav class="footer-nav">
			<h4>Useful Links</h4>
		      <?php
		        if (has_nav_menu('footer_navigation')) :
		          wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'nav'));
		        endif;
		      ?>
	    </nav>
		<div class="structured-data">
			<?php echo krank_structured_business();?>
		</div>
	</div>
  </div>
</footer>
<div class="site-author container">
	Design &amp; website build by: <a href="http://www.krankcreative.co.uk" title="See What Krank Creative Can Do For You! Web Design, Graphic Design, Marketing &amp; E-commerce | Kendal, Cumbria"><span>Krank Creative </span>| Website Design, Marketing &amp; E-commerce Solutions | Kendal, Cumbria.</a>
</div>

<?php get_template_part('templates/modals'); // Custom Modals?>

<?php wp_footer(); ?>