<footer class="content-info container" role="contentinfo">
  <div class="row">
    <div>
      <?php dynamic_sidebar('sidebar-footer'); ?>
	  <?php echo krank_structured_business();?>
    </div>
    <nav class="foot footer-nav">
	<h4>Useful Links</h4>
      <?php
        if (has_nav_menu('footer_navigation')) :
          wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'nav'));
        endif;
      ?>
    </nav>
  </div>
</footer>
<div class="author container">
	Design &amp; website build by: <a href="http://www.krankcreative.co.uk" title="See What Krank Creative Can Do For You! Web Design, Graphic Design, Marketing &amp; E-commerce | Kendal, Cumbria"><span>Krank Creative </span>| Website Design, Marketing &amp; E-commerce Solutions | Kendal, Cumbria.</a>
</div>

<?php wp_footer(); ?>
