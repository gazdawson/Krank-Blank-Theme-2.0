<?php echo get_avatar($comment, $size = '64'); ?>
<div class="media-body">
	<div class="comment-content">
	  <h4 class="media-heading"><?php echo get_comment_author_link(); ?> Says:</h4>
	  <time datetime="<?php echo comment_date('c'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s', 'roots'), get_comment_date(),  get_comment_time()); ?></a></time>
	 <div class="edit-reply">
		 <?php edit_comment_link(__('<i class="fa-pencil"></i>', 'roots'), '', ' | '); ?>
		 <?php comment_reply_link(array_merge($args, array('reply_text' => '<i class="fa-reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
	 </div>
	 
	  <?php if ($comment->comment_approved == '0') : ?>
	    <div class="alert alert-info">
	      <?php _e('Your comment is awaiting moderation.', 'roots'); ?>
	    </div>
	  <?php endif; ?>
	  <?php comment_text(); ?>
	</div>
