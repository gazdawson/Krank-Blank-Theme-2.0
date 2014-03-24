<article <?php post_class(); ?>>
	<div class="feat-img">
		<?php if(get_post_meta($post->ID, '_krank_feat_post', true)) { ?>
			<div class="feat-post">
				<i class="fa-star"></i> <span>Featured Post <i class="fa-star"></i></span>
			</div>
		<?php } // endif ?>
		<a href="<?php the_permalink(); ?>" title="Read <?php the_title(); ?>">
			<?php if ( get_the_post_thumbnail() != '' ): ?>
				<?php the_post_thumbnail('post-thumb'); ?>
			<?php else: ?>
				<span class="img-soon"><i class="fa-picture-o"></i> Image Coming Soon!</span>
			<?php endif; ?>
			<span class="img-more">
				<i class="fa-share"></i>
			</span>
		</a>
	</div>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
	<?php the_excerpt(); ?>
	<a class="btn btn-sm read-more" href="<?php the_permalink(); ?>" title="Continue reading <?php the_title(); ?>" >Read More</a>
  </div>
</article>