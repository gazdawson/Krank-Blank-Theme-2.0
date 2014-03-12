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
			</div>
		</div>
	</div>
</div><!--/#contactModal-->

<div class="modal fade" id="photo-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<img src="" />
	</div><!-- /.modal-dialog -->
</div><!-- /#photo-modal .modal -->