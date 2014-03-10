<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
		<?php if(get_post_meta($post->ID, '_krank_feat_post', true)) { ?>
			<div class="feat-post">
				<span><i class="fa-star"></i> Featured Post</span>
			</div>
		<?php } // endif ?>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
	  <?php the_tags(); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
