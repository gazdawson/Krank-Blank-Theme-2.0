<footer class="content-info container" role="contentinfo">
  <div class="footer">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <nav class="footer-nav">
		<h4>Useful Links</h4>
	      <?php
	        if (has_nav_menu('footer_navigation')) :
	          wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'nav'));
	        endif;
	      ?>
    </nav>
	<div class="strutured-data">
		<?php echo krank_structured_business();?>
	</div>
  </div>
</footer>
<div class="author container">
	Design &amp; website build by: <a href="http://www.krankcreative.co.uk" title="See What Krank Creative Can Do For You! Web Design, Graphic Design, Marketing &amp; E-commerce | Kendal, Cumbria"><span>Krank Creative </span>| Website Design, Marketing &amp; E-commerce Solutions | Kendal, Cumbria.</a>
</div>

<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="ConactModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="ConactModal">Contact Us</h4>
				<p>Please use the contact form below to send us a message.</p>
				<?php echo do_shortcode('[contact-form]'); ?>
			</div>
			<div class="modal-footer">
				<p>Alternatively use one of our other forms of contact to get in touch</p>
				<?php echo do_shortcode('[contact]'); ?>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div><!--/#contactModal-->

<?php wp_footer(); ?>