<div class="author-bio">
    <?php
   		$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>
	
	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
	</div><!-- .author-avatar -->
	
	<div class="author-meta">
	    <h1><?php echo $curauth->display_name; ?></h1>
		<p><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
		<p><?php echo $curauth->user_description; ?></p>
	</div>
</div>

<div class="author-posts">
    <h2>Posts by <?php echo $curauth->display_name; ?>:</h2>

    <ul>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
            <?php the_title(); ?></a>,
            <?php the_time('d M Y'); ?> in <?php the_category('&');?>
        </li>
    <?php endwhile; else: ?>
        <p><?php _e('No posts by this author.'); ?></p>
    <?php endif; ?>
    </ul>
</div>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'krank')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'krank')); ?></li>
    </ul>
  </nav>
<?php endif; ?>

